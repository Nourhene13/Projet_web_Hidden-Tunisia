// Initialize variables
let turn = "X";
let board = ["", "", "", "", "", "", "", "", ""];
let gameOver = false;

// Get table cells and add event listeners
let cells = document.querySelectorAll("#board td");
for (let i = 0; i < cells.length; i++) {
	cells[i].addEventListener("click", function() {
		if (!gameOver && board[i] == "") {
			board[i] = turn;
			this.textContent = turn;
			checkForWin();
			switchTurn();
		}
	});
}

// Reset button
document.querySelector("#reset").addEventListener("click", resetGame);

// Switch turn
function switchTurn() {
	if (turn == "X") {
		turn = "O";
	} else {
		turn = "X";
	}
	document.querySelector("#message").textContent = "It's " + turn + "'s turn!";
}

// Check for win
function checkForWin() {
	let winningCombinations = [
		[0, 1, 2], [3, 4, 5], [6, 7, 8], // horizontal
		[0, 3, 6], [1, 4, 7], [2, 5, 8], // vertical
		[0, 4, 8], [2, 4, 6] // diagonal
	];
	for (let i = 0; i < winningCombinations.length; i++) {
		let a = winningCombinations[i][0];
		let b = winningCombinations[i][1];
		let c = winningCombinations[i][2];
		if (board[a] != "" && board[a] == board[b] && board[b] == board[c]) {
			gameOver = true;
			document.querySelector("#message").textContent = turn + " wins!";
			break;
		} else if (!board.includes("")) {
			gameOver = true;
			document.querySelector("#message").textContent = "Tie game!";
		}
	}
}

