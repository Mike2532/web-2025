const nums = {a: 1, b: 2, c: 3, d: 'hello'};

function mapObject(nums, callback) {
    return Object.fromEntries(Object.entries(nums).map(([key, val]) => [key, callback(val)]))
}

function mult(x) {
    if (Number.isFinite(x)) {
        return x * x
    } else {
        return x
    }
}

console.log(mapObject(nums, mult))