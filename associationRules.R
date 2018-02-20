#Implementing Market Basket Analysis using Apriori Algorithm
setwd("C:/xampp/htdocs/DAI")
library(RMySQL)
drv <- dbDriver("MySQL")
drv

#-----------database connection with the R---------------------
con <- dbConnect(drv,dbname="ims",user="root",password="",host="localhost")
con
class(con)

#read transaction from database and dave to csv
database_data <- dbGetQuery(con,"select * from transaction")
write.csv(database_data,"groceries_dataBase.csv",row.names = F,quote = F)


#---------------------data preprocessing---------------------
#data from the database my have unwanted white strip and addition line, so removing them
df_groceries <-read.table("groceries_dataBase.csv",header=T,sep=",",quote="",dec=".",strip.white = T,blank.lines.skip = T,comment.char = "",allowEscapes = F)
df_groceries$quantity <- 1

df_groceries<-unique(df_groceries)

#convert dataframe to transaction format using ddply; 
#group all the items that were bought together; by the same customer on the same date
library(plyr)
df_itemList <- ddply(df_groceries, c("memberNumber","purchaseDate"), function(df1)paste(df1$itemName,collapse = ","))

#remove member number and date
df_itemList$memberNumber <- NULL
df_itemList$purchaseDate <- NULL

colnames(df_itemList) <- c("itemList")

#write to csv format
write.table(df_itemList,"ItemList",sep = "," ,quote = F, row.names = T)
#basket format of rules is generated

#-------------------- association rule mining algorithm : apriori -------------------------#

#load package required
library(arulesViz)

#convert csv file to basket format
txn = read.transactions("ItemList",sep=",", rm.duplicates= T, format="basket",cols=1);

#remove quotes from transactions
txn@itemInfo$labels <- gsub("\"","",txn@itemInfo$labels)


#run apriori algorithm
basket_rules <- apriori(txn,parameter = list(minlen=2,sup = 0.001, conf = 0.01, target="rules"))
#basket_rules <- apriori(txn,parameter = list(minlen=2,maxlen=4, sup = 0.0001, conf = 0.01, target="rules"))


#view rules
inspect(basket_rules[1:5])

#convert to datframe and view; optional
df_basket <- as(basket_rules,"data.frame")
df_basket$confidence <- df_basket$confidence * 100

#storing the rules into table
dbWriteTable(con,name="association_rules", as(basket_rules,"data.frame"), overwrite = T,row.names=T)

subrules2 <- head(sort(basket_rules, by="lift"), 25)

#-------------------Visualization--------------------
#used to show the rules generatied in as Visualization

setwd("img")

svg(filename="graph.svg", 
    width=10, 
    height=9, 
    pointsize=12)
plot(subrules2,method = "graph", shading = NA)
dev.off()

remove(df_basket,df_groceries,basket_rules,con,drv,txn,database_data,df_itemList,subrules2,rules.column,rules.separated,rules.separatedHead)
