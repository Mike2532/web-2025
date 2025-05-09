const nums = [2, 5, 8, 10, 3]

function trippleAndFilterArray(nums) {
    return nums.map(x => x * 3).filter(x => x > 10)
}

console.log(trippleAndFilterArray(nums))