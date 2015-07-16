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

			$(document).ready(function(){
				
				tiles[1][1]=2;
				tiles[3][2]=124;				
				for(var i=0;i<row;i++){
					//var number=0;
					$(".grid").append('<div class="row"></div>');
					for(var y=0;y<cell;y++){
						
						//alert(number++);
						if(tiles[i][y]>0){
							var changeColor = Math.log(tiles[i][y])/Math.log(2);
							console.log((255-(255-changeColor)/11));
							console.log("this"+changeColor+(255/11));
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
			});
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