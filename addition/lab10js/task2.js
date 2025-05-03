vovels = ['а', 'е', 'ё', 'и', 'о', 'у', 'ы', 'э', 'ю', 'я']

function countVowels(str) {
    let counter = 0
    let comment = '('
    for (let letter of str) {
        if (vovels.includes(letter)) {
            if (counter > 0) {
                comment += ', '
            }
            comment += letter
            counter++
        }
    }
    comment += ')'
    console.log(counter + ' ' + comment)
}