$(document).ready( function () {
var myCanvas = document.getElementById("myCanvas");
myCanvas.width = 420;
myCanvas.height = 300;
   myCanvas.style.float = "left";
var ctx = myCanvas.getContext("2d");
 
function drawLine(ctx, startX, startY, endX, endY,color){
    ctx.save();
    ctx.strokeStyle = color;
    ctx.beginPath();
    ctx.moveTo(startX,startY);
    ctx.lineTo(endX,endY);
    ctx.stroke();
    ctx.restore();
}
 
function drawBar(ctx, upperLeftCornerX, upperLeftCornerY, width, height,color){
    ctx.save();
    ctx.fillStyle=color;
    ctx.fillRect(upperLeftCornerX,upperLeftCornerY,width,height);
    ctx.restore();
}
 
var myVinyls = {
    "Dental": 20,
    "Machine": 30,
    "Tooth": 15,
    "Medic": 30,
	"Anabol": 50,
	"Antib": 43,
	"Dentalg": 20,
    "Machine": 30,
	"Machined": 30,
	"Machine1": 30,
	"Machine2": 30
};
 
var Barchart = function(options){
    this.options = options;
    this.canvas = options.canvas;
    this.ctx = this.canvas.getContext("2d");
    this.colors = options.colors;
	this.options.padding =  65;

  
    this.draw = function(){
        var maxValue = 0;
        for (var categ in this.options.data){
            maxValue = Math.max(maxValue,this.options.data[categ]);
        }
		console.log(maxValue);
        var canvasActualHeight = this.canvas.height - this.options.padding * 2;
        var canvasActualWidth = this.canvas.width - this.options.padding * 2;
 
        //drawing the grid lines
        var gridValue = 0;
        while (gridValue <= maxValue+this.options.gridScale){
            var gridY = canvasActualHeight * (1 - gridValue/maxValue) + this.options.padding;
            drawLine(
                this.ctx,
                25,
                gridY,
                this.canvas.width,
                gridY,
                this.options.gridColor
            );
             
            //writing grid markers
            this.ctx.save();
            this.ctx.fillStyle = this.options.gridColor;
            this.ctx.textBaseline="bottom"; 
            this.ctx.font = "bold 10px Arial";
			this.ctx.fillStyle = "#000000";
            this.ctx.fillText(gridValue, 5,gridY - 2);
            this.ctx.restore();
 
            gridValue+=this.options.gridScale;
        }      
		
		
		
		
		
  
        //drawing the bars
        var barIndex = 0;
        var numberOfBars = Object.keys(this.options.data).length;
	
        var barSize = (canvasActualWidth)/(numberOfBars*2);
		console.log(canvasActualWidth);
		drawLine(
                this.ctx,
                25,
                this.options.padding/3,
                25,
                240,
                this.options.gridColor
            );
        for (categ in this.options.data){
            var val = this.options.data[categ];
            var barHeight = Math.round( canvasActualHeight * val/maxValue) ;
            drawBar(
                this.ctx,
                this.options.padding + barIndex * (barSize + 200/numberOfBars),
                this.canvas.height - barHeight - this.options.padding,
                barSize,
                barHeight,
                this.colors[barIndex%this.colors.length]
            );

			var gridX = this.options.padding + barSize + 100/numberOfBars + barIndex * (barSize + 200/numberOfBars);
            drawLine(
                this.ctx,
                gridX,
                240,
                gridX,
                235,
                this.options.gridColor
            );
			
			
			this.ctx.save();
            this.ctx.fillStyle = this.options.gridColor;
            this.ctx.textBaseline="bottom"; 
            this.ctx.font = "bold 10px Arial";
			this.ctx.fillStyle = "#000000";
            this.ctx.fillText(barIndex, this.options.padding + barIndex * (barSize + 200/numberOfBars)+barSize/2-2,250);
            this.ctx.restore();
			console.log(barIndex);
            barIndex++;
        }
		
		
		
        //drawing series name
        this.ctx.save();
        this.ctx.textBaseline="bottom";
        this.ctx.textAlign="center";
        this.ctx.fillStyle = "#000000";
        this.ctx.font = "bold 14px Arial";
        this.ctx.fillText(this.options.seriesName, this.canvas.width/2,this.canvas.height);
        this.ctx.restore();  
         
        //draw legend
        barIndex = 0;
        var legend = document.querySelector("legend[for='myCanvas']");
        var ul = document.createElement("ul");
		ul.style.listStyle = "none";
		ul.style.float = "left";
		ul.style.paddingTop = "100px";
        legend.append(ul);
        for (categ in this.options.data){
            var li = document.createElement("li");
            li.style.listStyle = "none";
	
            li.style.borderLeft = "5px solid "+this.colors[barIndex%this.colors.length];
			li.style.height = "5px";
			li.style.lineHeight = "5px";
			li.style.marginBottom = "10px";
            li.textContent = categ;
            ul.append(li);
            barIndex++;
        }
    }
}
 
 
var myBarchart = new Barchart(
    {
        canvas:myCanvas,
        seriesName:"Lab4",
        padding:20,
        gridScale:10,
        gridColor:"#757575",
        data:myVinyls,
        colors:["#a55ca5","#67b6c7", "#bccd7a","#eb9743","#7575ad", "#67cd7a" ]
    }
);

myBarchart.draw();
});