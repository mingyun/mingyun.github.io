<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>2048http://www.oschina.net/code/snippet_139971_35449</title>
<link rel="stylesheet" type="text/css" href="css/2048.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script> 

<style>

#div2048
{
    width: 500px;
    height: 500px;
    background-color: #b8af9e;
    margin: 0 auto;
    position: relative;
}
#div2048 div.tile
{
    margin: 20px 0px 0px 20px;
    width: 100px;
    height: 40px;
    padding: 30px 0;
    font-size: 40px;
    line-height: 40px;
    text-align: center;
    float: left;
}
#div2048 div.tile0{
	background: #ccc0b2;
}
#div2048 div.tile2
{
    color: #7c736a;
    background: #eee4da;
}
#div2048 div.tile4
{
    color: #7c736a;
    background: #ece0c8;
}
#div2048 div.tile8
{
    color: #fff7eb;
    background: #f2b179;
}
#div2048 div.tile16
{
    color:#fff7eb;
    background:#f59563;
}
#div2048 div.tile32
{
    color:#fff7eb;
    background:#f57c5f;
}
#div2048 div.tile64
{
    color:#fff7eb;
    background:#f65d3b;
}
#div2048 div.tile128
{
    color:#fff7eb;
    background:#edce71;
}
#div2048 div.tile256
{
    color:#fff7eb;
    background:#edcc61;
}
#div2048 div.tile512
{
    color:#fff7eb;
    background:#ecc850;
}
#div2048 div.tile1024
{
    color:#fff7eb;
    background:#edc53f;
}
#div2048 div.tile2048
{
    color:#fff7eb;
    background:#eec22e;
}
</style>
</head>

<body>
	<div id="div2048">
    </div>
	<script type="text/javascript">
function game2048(container)
{
	this.container = container;
	this.tiles = new Array(16);
	this.init();
}

game2048.prototype = {
	init: function(){
		for(var i = 0, len = this.tiles.length; i < len; i++){
			var tile = this.newTile(0);
			tile.setAttribute('index', i);
			this.container.appendChild(tile);
			this.tiles[i] = tile;
		}
		this.randomTile();
		this.randomTile();
	},
	newTile: function(val){
		var tile = document.createElement('div');
		this.setTileVal(tile, val)
		return tile;
	},
	setTileVal: function(tile, val){
		tile.className = 'tile tile' + val;
		tile.setAttribute('val', val);
		tile.innerHTML = val > 0 ? val : '';
	},
	randomTile: function(){
		var zeroTiles = [];
		for(var i = 0, len = this.tiles.length; i < len; i++){
			if(this.tiles[i].getAttribute('val') == 0){
				zeroTiles.push(this.tiles[i]);
			}
		}
		var rTile = zeroTiles[Math.floor(Math.random() * zeroTiles.length)];
		this.setTileVal(rTile, Math.random() < 0.8 ? 2 : 4);
	},
	move:function(direction){
		var j;
		switch(direction){
			case 'W':
				for(var i = 4, len = this.tiles.length; i < len; i++){
					j = i;
					while(j >= 4){
						this.merge(this.tiles[j - 4], this.tiles[j]);
						j -= 4;
					}
				}
				break;
			case 'S':
				for(var i = 11; i >= 0; i--){
					j = i;
					while(j <= 11){
						this.merge(this.tiles[j + 4], this.tiles[j]);
						j += 4;
					}
				}
				break;
			case 'A':
				for(var i = 1, len = this.tiles.length; i < len; i++){
					j = i;
					while(j % 4 != 0){
						this.merge(this.tiles[j - 1], this.tiles[j]);
						j -= 1;
					}
				}
				break;
			case 'D':
				for(var i = 14; i >= 0; i--){
					j = i;
					while(j % 4 != 3){
						this.merge(this.tiles[j + 1], this.tiles[j]);
						j += 1;
					}
				}
				break;
		}
	},
	merge: function(prevTile, currTile){
		var prevVal = prevTile.getAttribute('val');
		var currVal = currTile.getAttribute('val');
		if(currVal != 0){
			if(prevVal == 0){
				this.setTileVal(prevTile, currVal);
				this.setTileVal(currTile, 0);
				this.randomTile();
			}
			else if(prevVal == currVal){
				this.setTileVal(prevTile, prevVal * 2);
				this.setTileVal(currTile, 0);
				this.randomTile();
			}
		}
	},
	equal: function(tile1, tile2){
		return tile1.getAttribute('val') == tile2.getAttribute('val');
	},
	max: function(){
		for(var i = 0, len = this.tiles.length; i < len; i++){
			if(this.tiles[i].getAttribute('val') == 2048){
				return true;
			}
		}
	},
	over: function(){
		var gameOver = true;
		for(var i = 0, len = this.tiles.length; i < len; i++){
			if(this.tiles[i].getAttribute('val') == 0){
				gameOver = false;
				break;
			}
			if(i % 4 != 3){
				if(this.equal(this.tiles[i], this.tiles[i + 1])){
					gameOver = false;
				}
			}
			if(i < 12){
				if(this.equal(this.tiles[i], this.tiles[i + 4])){
					gameOver = false;
				}
			}
		}
		return gameOver;
	}
}

var game;

window.onload = function(){
	var container = document.getElementById('div2048');
	game = new game2048(container);
}

window.onkeydown = function(e){
	var keynum, keychar;
	if(window.event){		// IE
		keynum = e.keyCode;
	}
	else if(e.which){		// Netscape/Firefox/Opera
		keynum = e.which;
	}
	keychar = String.fromCharCode(keynum);
	if(['W', 'S', 'A', 'D'].indexOf(keychar) > -1){
		if(game.over()){
			alert('game over:-(');
			return;
		}
		game.move(keychar);
	}
}

</script>

</body>
</html>