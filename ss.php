<html>
<body>
<style>
  div.tooltip { 
    position: absolute;     
    text-align: center;     
    width: 60px;          
    height: 28px;         
    padding: 2px;       
    font: 70px sans-serif;    
    border: 0px;    
    border-radius: 8px;     
    pointer-events: none;     
}
</style>

<script src="http://d3js.org/d3.v3.min.js"></script>

<script>
var margin = {top: 100, right: 80, bottom: 100, left:80},
    width = 700 ,
    height = 700,
    padding = 1.5, // separation between same-color circles
    clusterPadding = 6, // separation between different-color circles
    maxRadius = 12;

    var j =[];


// var x = d3.time.scale().range([0, width]);
// var	y = d3.scale.linear().range([height, 0]);



var div = d3.select("body").append("div") 
    .attr("class", "tooltip")       
    .style("opacity", 0);


var svg1= d3.select("#clusterViz").append("svg")
    .attr("width",  width + margin.right + margin.left)
    .attr("height",  height + margin.top + margin.bottom+50)
	.append("g")
	.attr("transform", "translate(" + margin.left + "," + margin.right + ")");


d3.csv("c.csv",function(csv){
            csv.map(function(d){
                
                j.push(+d.Freq);
            })
            //called after the AJAX is success
 console.log(j);
            
        
//var n = 200, // total number of circles
m =4; // number of distinct clusters

console.log(m);

var color = d3.scale.category10()
.domain(d3.range(m));

// The largest node for each cluster.
    var clusters = new Array(m);

//cn contains j value, i is index of j array
var nodes = [];
j.forEach(function (cn, i) {
//this will make a cluster
console.log(cn);
console.log(i);
 
for (var k = 0; k < cn; k++) {
//this loop will make all the nodes
 var p = Math.floor(Math.random()), r = Math.sqrt((p+1) /(m+2) * -Math.log(Math.random())) * maxRadius;
        var d = {
            cluster: i,
            radius: r,
            x: Math.cos(i / m * 2 * Math.PI) * 200 + width / 2 + Math.random(),
            y: Math.sin(i / m * 2 * Math.PI) * 200 + height / 2 + Math.random()
        };
        if (!clusters[i] || (r > clusters[i].radius)) clusters[i] = d;
        nodes.push(d);
    }
});


var force = d3.layout.force()
    .nodes(nodes)
    .size([width, height])
    .gravity(.02)
    .charge(0)
    .on("tick", tick)
    .start();

var circle = svg1.selectAll("circle")
    .data(nodes)
   .enter().append("circle") 
   .attr("r", function(d) { return d.radius; })
    .style("fill", function(d) { return color(d.cluster); })               
    .attr("cy", function(d) { return d.cluster; })   
        .on("mouseover", function(d) {    
            div.transition()    
                .duration(200)    
                .style("opacity", .9);    
            div .html( d.cluster+1)  
                .style("left", (d3.event.pageX) + "px")   
                .style("top", (d3.event.pageY - 28) + "px");  
            })          
        .on("mouseout", function(d) {   
            div.transition()    
                .duration(500)    
                .style("opacity", 0); 
        })
.call(force.drag);

  
function tick(e) {
  circle
      .each(cluster( 10*e.alpha * e.alpha))
      .each(collide(.3))
      .attr("cx", function(d) { return d.x; })
      .attr("cy", function(d) { return d.y; });

  
}

// Move d to be adjacent to the cluster node.
function cluster(alpha) {
  return function(d) {
    var cluster = clusters[d.cluster];
    if (cluster === d) return;
    var x = d.x - cluster.x,
        y = d.y - cluster.y,
        l = Math.sqrt(x * x + y * y),
        r = d.radius + cluster.radius;
    if (l != r) {
      l = (l - r) / l * alpha;
      d.x -= x *= l;
      d.y -= y *= l;
      cluster.x += x;
      cluster.y += y;
    }
  };
}

// Resolves collisions between d and all other circles.
function collide(alpha) {
  var quadtree = d3.geom.quadtree(nodes);
  return function(d) {
    var r = d.radius + maxRadius + Math.max(padding, clusterPadding),
        nx1 = d.x - r,
        nx2 = d.x + r,
        ny1 = d.y - r,
        ny2 = d.y + r;
    quadtree.visit(function(quad, x1, y1, x2, y2) {
      if (quad.point && (quad.point !== d)) {
        var x = d.x - quad.point.x,
            y = d.y - quad.point.y,
            l = Math.sqrt(x * x + y * y),
            r = d.radius + quad.point.radius + (d.cluster === quad.point.cluster ? padding : clusterPadding);
        if (l < r) {
          l = (l - r) / l * alpha;
          d.x -= x *= l;
          d.y -= y *= l;
          quad.point.x += x;
          quad.point.y += y;
        }
      }
      return x1 > nx2 || x2 < nx1 || y1 > ny2 || y2 < ny1;
    });
  };
}
});

</script>
</body>
</html>
