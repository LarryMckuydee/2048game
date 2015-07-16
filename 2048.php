<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/2048.css">
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script>
			var row = 4;
			var cell = 4;
			var gameover = false;
			var tiles = new Array(row);

			for (var i=0;i<cell;i++){
				tiles[i] = new Array(cell);
			}
			var temp = new Array(row);
			for (var i=0;i<cell;i++){
				temp[i] = new Array(cell);
			}

			function spawn(){
				var availableRow = [];
				var availableCell = [];
				for(var i = 0;i<row;i++){
					for(var y = 0;y<cell;y++){
						if(tiles[i][y]==0){
							availableRow[availableRow.length]=i;
							availableCell[availableCell.length]=y;
						}
					}
				}
				var rand = Math.floor(Math.random()*availableRow.length);
				//var randrow = Math.floor(Math.random()*availableRow.length);
				//var randcell = Math.floor(Math.random()*availableCell.length);
				//console.log("this "+availableRow[randrow]+" row "+randrow);
				//console.log("this "+availableCell[randrow]+" cell "+randcell);
				tiles[availableRow[rand]][availableCell[rand]]=Math.floor(Math.random()*2)?2:4;
			}

			function start(){
				//tiles[1][1]=2;
				//tiles[3][2]=124;
				$(".grid").empty();

				for(var i=0;i<row;i++){
					//var number=0;
					$(".grid").append('<div class="row"></div>');
					for(var y=0;y<cell;y++){
						
						//alert(number++);
						if(tiles[i][y]>0){
							var changeColor = Math.log(tiles[i][y])/Math.log(2);
							//console.log((255-(255-changeColor)/11));
							//console.log("this"+changeColor+(255/11));
							var colorR=(255-(255-changeColor)/11);
							var colorG=(changeColor+(255/11));
							var cellElements= $('<div class="cell">'+tiles[i][y]+'</div>').css("background-color","rgba("+colorR.toFixed()+","+colorG.toFixed()+",0,1)");
							$(".row").last().append(cellElements);
							continue;
						}
						$(".row").last().append('<div class="cell"></div>');
					}
				}

				if(gameover){
					$("<div/>").css({
						"position":"absolute",
						"width":"100%",
						"height":"110%",
						"z-index":100,
						"background-color":"rgba(255,255,255,0.5)",
						"left":0,
						"top":0
					}).appendTo($(".grid"));
				}
			}

			
			$(document).ready(function(){
				for(var i = 0;i<row;i++){
					for(var y = 0;y<cell;y++){
						tiles[i][y] = 0;
					}
				}
				//spawn();
				//spawn();
				slide(-1,0);
				

			});

			$(document).keydown(function(e){
				console.log(e.keyCode);
				if(e.keyCode==39){
					//right
				}else if(e.keyCode==37){
					//left
				}else if(e.keyCode==38){
					//up
				}else if(e.keyCode==40){
					//down
				}
			});

			function slide(drow,dcell){
				if(drow!=0||dcell!=0){
					var direction = drow == 0?dcell:drow;
					//console.log(direction);
					for(var i = 0;i<row;i++){
						for(var y = 0;y<cell;y++){
							temp[i][y] = tiles[i][y];
						}
					}
					//always check from opposite direction
					for(var i =0;i<row;i++){
						for(var y = direction > 0?0:cell-1;y != (direction>0?cell:-1);y += direction){
							//alert(y);
							var switcherA = drow == 0?i:y;
							var switcherB = drow == 0?y:i;
							//console.log(switcherA);
							console.log(y);
							//if(tiles[switcherA][switcherB] == 0 ) continue;
							tiles[switcherA][switcherB] = 2;


											start();
							alert("hey");		

						}
					}
				}
			}
		</script>
	</head>
	<body>
		<div class="container">
			<label>SCORE:</label>
			<label class="score">0</label>
			<div class="grid">
				<!--div class="row">
					<div class="cell"></div>
					<div class="cell"></div>
					<div class="cell"> </div>
					<div class="cell"> </div>
				</div>
				<div class="row">
					<div class="cell"> </div>
					<div class="cell"> </div>
					<div class="cell"> </div>
					<div class="cell"> </div>
				</div>
				<div class="row">
					<div class="cell"> </div>
					<div class="cell"> </div>
					<div class="cell"> </div>
					<div class="cell"> </div>
				</div>
				<div class="row">
					<div class="cell"> </div>
					<div class="cell"> </div>
					<div class="cell"> </div>
					<div class="cell"> </div>
				</div-->
			</div>
		</div>
	</body>
	<footer>
		
	</footer>
</html>