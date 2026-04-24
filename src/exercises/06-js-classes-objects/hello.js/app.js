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
