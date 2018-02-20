  #coded by:yushghimire
  setwd("C:/xampp/htdocs/DAI")
  #load library
  library(randomForest)
  library(e1071)
  library(caret)
  ## Loading required package: lattice
  ## Loading required package: ggplot2
  
  # Help on ramdonForest package and function
  
  #Random Forest
  df_item <-read.table("Customer.csv",header=T,sep=",",dec=".",strip.white = T,blank.lines.skip = T,comment.char = "",allowEscapes = F)
  table(df_item$response)/nrow(df_item)
  
  df_item[is.na(df_item)]<-'yes'
  
  table(df_item$response)/nrow(df_item)
  
  str(df_item)
  set.seed(1000)
  #used in random sampling from the dataset
  #replace = T is sample with replacement, probability takes 60% of no and 40% of yesssssss
  sample.data <- sample(2, 
                       nrow(df_item),
                       replace = T,
                       prob = c(0.30,0.70))
  
  
  train.set <- df_item[sample.data==1,]
  test.set <- df_item[sample.data==2,]
  
  str(train.set)
  str(test.set)
  #checking the ratio of no and yes in the sample training data and test data
  table(train.set$response)/nrow(train.set)
  table(test.set$response)/nrow(test.set)
  
  varNames <- names(train.set)
  # Exclude ID or Response variable
  varNames <- varNames[!varNames %in% c("memberNumber","response")]
  
  # add + sign between exploratory variables
  forestFormula <- paste(varNames, collapse = "+")
  
  # Add response variable and convert to a formula object, which is to be used in Random Forest
  randomForest.formula <- as.formula(paste("response", forestFormula, sep = " ~ "))
  
  #takes the formula as the first attribute, second attribute is the data
  #attribute ntree is number of tree to grow
  randomForest.result <- randomForest(randomForest.formula,
                                train.set,
                                ntree=500,
                                norm.votes = T,
                                importance=T)
  
  varImpPlot(randomForest.result)
  plot(randomForest.result)
  
  # Predicting response variable
  test.set$Random_response <- predict(randomForest.result ,test.set)
  df_item$Random_response <- predict(randomForest.result ,df_item)
  
  # Create Confusion Matrix
  confusionMatrix(data=test.set$Random_response,
                  reference=test.set$response)
  
  remove(forestFormula,randomForest.formula,randomForest.result,sample.data,varNames)
  
  #--------------------------------------SVM-----------------------
  
  varNames <- names(train.set)
  # Exclude ID or Response variable
  varNames <- varNames[!varNames %in% c("memberNumber","response","Random_response")]
  
  # add + sign between exploratory variables
  formula <- paste(varNames, collapse = "+")
  
  # Add response variable and convert to a formula object, which is to be used in Random Forest
  SVM.formula <- as.formula(paste("response", formula, sep = " ~ "))
  
  svm.model <- svm(SVM.formula, data = train.set, kernel= "radial", cost = 100, gamma = 1)
  
  test.set$SVM_response <- predict (svm.model, test.set)
  df_item$SVM_response <- predict (svm.model, df_item)
  
  # Create Confusion Matrix
  confusionMatrix(data=test.set$SVM_response,
                  reference=test.set$response)
  
  remove(formula,SVM.formula,svm.model,varNames)
  
  #-----------------boosting to increase accuracy--------------------
  library (fastAdaboost)
  varNames <- names(train.set)
  # Exclude ID or Response variable
  varNames <- varNames[!varNames %in% c("memberNumber","response")]
  
  # add + sign between exploratory variables
  formula <- paste(varNames, collapse = "+")
  
  # Add response variable and convert to a formula object, which is to be used in Random Forest
  adaboost.formula <- as.formula(paste("response", formula, sep = " ~ "))
  
  adaboost.model = adaboost(adaboost.formula,train.set,500)
  
  adaboost.response <- predict (adaboost.model, test.set)
  adaboostdf.response <- predict (adaboost.model, df_item)
  
  print(table(adaboost.response$class,test.set$response))
  
  test.set$adaBoost_response<- adaboost.response$class
  df_item$adaBoost_response<- adaboostdf.response$class
# Create Confusion Matrix
confusionMatrix(data=test.set$adaBoost_response,
                  reference=test.set$response)

df_item$recency.log <- NULL
df_item$frequency.log <- NULL
df_item$monetary.log <- NULL
df_item$recency.z <- NULL
df_item$frequency.z <- NULL
df_item$monetary.z <- NULL
df_item$Recency <- NULL
df_item$Monetary <- NULL
df_item$Frequency <- NULL

remove(adaboost.formula,adaboost.model,adaboost.response,formula,varNames)

df_item$total_response <- ifelse(df_item$Random_response =='yes' | df_item$SVM_response =='yes' | df_item$adaBoost_response =='yes' , 'yes', 'no')

# Create Confusion Matrix
confusionMatrix(data=df_item$total_response,
                reference=df_item$response)

df_item$total_response <- ifelse(df_item$Random_response =='yes' | df_item$SVM_response =='yes' | df_item$adaBoost_response =='yes' , 1, 0)

write.csv(df_item,"customerUpload.csv",row.names = F,quote = F)

