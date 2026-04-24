// exercise 1
function squareAndFilterEven(numbers) {
  var result = [];

  for (var i = 0; i < numbers.length; i++) {
    var squared = numbers[i] * numbers[i];
    if (squared % 2 === 0) {
      result.push(squared);
    }
  }

  return result;
}

console.log(squareAndFilterEven([3, 6, 7, 2, 4]));

// exercise 2
function countAboveThreshold(numbers, threshold) {
  var count = 0;

  for (var i = 0; i < numbers.length; i++) {
    if (numbers[i] > threshold) {
      count++;
    }
  }

  return count;
}

console.log(countAboveThreshold([10, 15, 25, 30, 5, 40], 20));
// 3

// exercise 3
function reverseWords(words) {
  var result = [];

  for (var i = 0; i < words.length; i++) {
    var reversed = "";
    for (var j = words[i].length - 1; j >= 0; j--) {
      reversed = reversed + words[i][j];
    }
    result.push(reversed);
  }

  return result;
}

console.log(reverseWords(["hello", "world"]));
