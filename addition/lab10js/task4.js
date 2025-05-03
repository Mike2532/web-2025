function mergeObjects(obj1, obj2) {
    for (let elem in obj1) {
        if (!(elem in obj2)) {
            obj2[elem] = obj1[elem] 
        }
    }
    
    for (let elem in obj2) {
        console.log(elem, obj2[elem])
    }
}