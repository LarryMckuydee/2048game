<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/2048.css">
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script>
			var row = 4;
			var cell = 4;
			var gameover = false;
			var tiles = new Array(row);
			var score = 0;

			for (var i=0;i<cell;i++){
				tiles[i] = new Array(cell);
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
				if(availableRow.length==0&& availableCell.length==0)return;
				var rand = Math.floor(Math.random()*availableRow.length);
				tiles[availableRow[rand]][availableCell[rand]]=Math.floor(Math.random()*2)?2:4;
			}

			function color(number){
				switch(number){
					case 2: return "rgba(238,228,218,1)";
					case 4: return "rgba(237,224,200,1)";
					case 8: return "rgba(242,177,121,1)";
					case 16: return "rgba(245,149,99,1)";
					case 32: return "rgba(246,124,95,1)";
					case 64: return "rgba(246,94,59,1)";
					case 128: return "rgba(237,207,114,1)";
					case 256: return "rgba(237,204,97,1)";
					case 512: return "rgba(237,200,80,1)";
					case 1024: return "rgba(237,197,63,1)";
					case 2048: return "rgba(150,143,114,1)";
					case 4096: return "rgba(150,134,100,1)";
					case 8192: return "rgba(147,130,93,1)";
					case 16384: return "rgba(130,119,79,1)";
					default: return "rgba(173,132,131,1)"

				}
			}

			function start(){
				$(".grid").empty();
				$(".score").empty();
				$(".score").text(score);

				for(var i=0;i<row;i++){
					$(".grid").append('<div class="row"></div>');
					for(var y=0;y<cell;y++){
						if(tiles[i][y]>0){
							var changeColor = Math.log(tiles[i][y])/Math.log(2);
							var cellElements= $('<div class="cell">'+tiles[i][y]+'</div>').css("background-color",color(tiles[i][y]));
							$(".row").last().append(cellElements);
							continue;
						}
						$(".row").last().append('<div class="cell"></div>');
					}
				}

				if(gameover){
					$("<div class='gameover'></div>").css({
						"position":"absolute",
						"width":"inherit",
						"height":"inherit",
						"z-index":100,
						"background-color":"rgba(255,255,255,0.5)",
						"left":0,
						"top":0,
						"padding-top":"30px",
						"padding-bottom":"30px",
						"display":"table"
					}).append($("<div>"+
						"<span>Game Over</span>"+
						"<br/><span>Total Score</span>"+
						"<br/><span>"+score+"</span>"+
						"<br/><button class='newgame' type='button'>New Game</button>"+
						"</div>").css({
						"display":"table-cell",
						"text-align":"center",
						"vertical-align":"middle",
						"font-size":"3em"
					})).appendTo($(".grid")).hide();

					$('.gameover').fadeIn(300);
					$('.newgame').click(function(){
						location.reload();
					});
				}
			}



			$(document).ready(function(){
				for(var i = 0;i<row;i++){
					for(var y = 0;y<cell;y++){
						tiles[i][y] = 0;
					}
				}
				spawn();
				spawn();
				start();
			});

			$(document).keydown(function(e){
				var drow =0;
				var dcell =0;
				var dxs = [0,0,-1,1];
				var dys = [-1,1,0,0];
				if(gameover) return;
				if(e.keyCode==39){
					//right
					dcell=1;
				}else if(e.keyCode==37){
					//left
					dcell=-1;
				}else if(e.keyCode==38){
					//up
					drow=-1;
				}else if(e.keyCode==40){
					//down
					drow=1;
				}else{
					return;
				}
					 
				var check = move(drow,dcell);
				if(check != null){
					tiles = check;
					spawn();
				}	
				gameover = true;
				for(var i = 0; i<4;i++ ){
					if(move(dys[i],dxs[i],true)!=null)
						gameover = false;
				}

				
				start();
				 
			});

			function move(dy,dx,check){
				var temp = new Array(row);
				for (var i=0;i<cell;i++){
					temp[i] = new Array(cell);
				}

				for(var i = 0; i < row;i++){
					for(var y = 0;y <cell;y++){
						temp [i][y] = tiles[i][y];
					}
				}
				var moved = false;
				if( dy !=0|| dx !=0){
					var direction = dx != 0 ? dx : dy;
					for(var i =0;i<tiles.length;i++){
						for(var j = (direction > 0 ?tiles.length-1 : 1); j != (direction > 0 ?-1:tiles.length); j -=direction){
							var y = dx != 0?i:j;
							var x = dx != 0?j:i;
							var ty = y;
							var tx = x;


							if(temp[y][x]==0) continue;


							for(var k= (dx !=0?x:y)+direction; k!= (direction>0?tiles.length:-1);k +=direction){
								var a = dx != 0? y : k;
								var b = dx != 0? k : x;


								if(temp[a][b] != 0 && temp[a][b] != tiles[y][x]) break;
								if(dx != 0)
									tx = k;
								else
									ty = k;



							}

							if((dy !=0 && ty==y)||(dx!=0 && tx==x))continue;
							else if(temp[ty][tx]==tiles[y][x]){
								temp[ty][tx]*=2;
								temp[y][x]=0;
								
								if(!check)
								score += temp[ty][tx];
								

								moved = true;
							}else if((dy!=0 && ty!=y)||(dx!=0&&tx!=x)){
								temp[ty][tx]=temp[y][x];
								temp[y][x]=0;
								
								moved = true;
							}

						}
					}

				}
				return moved?temp:null;
			}
				
			
		</script>
	</head>
	<body>
		<div class="container">
			<label>SCORE:</label>
			<label class="score">0</label>
			<div class="grid">
			</div>
		</div>
	</body>
	<footer>
		
	</footer>
</html>