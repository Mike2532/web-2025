const firstObj = {a: 1, b: 2}
const secontObj = {b: 3, c: 4}

function mergeObjects(firstObj, secontObj) {
    const tempObj = copyObject(secontObj)

    for (let elem in firstObj) {
        if (!(elem in tempObj)) {
            tempObj[elem] = firstObj[elem] 
        }
    }
    
    return tempObj
}

function copyObject(copyingObj) {
    const copyOfObj = {}
    for (let key in copyingObj) {
        copyOfObj[key] = copyingObj[key]
    }
    return copyOfObj
}

console.log(mergeObjects(firstObj, secontObj))
console.log(firstObj)
console.log(secontObj)