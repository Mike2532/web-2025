const nums = {a: 1, b: 2, c: 3, d: 'hello'};

function mapObject(nums, callback) {
    const obj = {}
    for (let key in nums) {
        obj[key] = callback(nums[key])
    }
    return obj
}

function double(x) {
    if (Number.isFinite(x)) {
        return x * 2
    } else {
        return x
    }
}

console.log(mapObject(nums, double))