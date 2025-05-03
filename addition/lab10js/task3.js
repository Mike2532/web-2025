function uniqueElements(elements) {
    const uniqueElements = {}

    for (let element of elements) {
        element = element.toString()
        if (element in uniqueElements) {
            uniqueElements[element]++
        } else {
            uniqueElements[element] = 1
        }
    }

    for (let elem in uniqueElements) {
        console.log(elem, ' ', uniqueElements[elem])
    }
}