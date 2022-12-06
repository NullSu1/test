function t(arr) {
  const one = arr[0];
  let result = []
  const oneLetterArr = one.split('').reverse();
  for (let i = 0; i < oneLetterArr.length; i++) {
    const letter = oneLetterArr[i];
    let flag = true;
    let res = ''
    for (let j = 1; j < arr.length; j++) {
      const item = arr[j];
      if (letter === item.split('').reverse()[i]) {
        res = letter;
      } else {
        flag = false;
      }
    }
    if (flag) {
      result.push(res)
    }
  }
  return result.reverse().join('');
}