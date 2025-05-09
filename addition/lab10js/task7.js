function getPassword(len) {
    if (typeof len === 'number') {
        if (len < 4) {
            return 'Ошибка: минимальная длина пароля 4 символа'
        } else {
            let password = ''
            let comands = getPasswordParts(len)
            for (let elem of comands) {
                password += getElem(elem)
            }
            return password
        }
    } else {
        return 'Ошибка типа данных: функция принимает только числа'
    }
}

function getElem(n) {
    const lowcase = 'abcdefghijklmnopqrstuvwxyzабвгдеёжзийклмнопрстуфхцчшщъыьэюя'
    const upcase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ'
    const nums = '0123456789'
    const symbols = '!@#$%^&*()_+-=[]{}|;:\'",.<>?/`~\\'

    switch(n) {
        case 0: 
            return lowcase[Math.floor(Math.random() * lowcase.length)] //строчная буква
        case 1:
            return upcase[Math.floor(Math.random() * upcase.length)] //заглавная буква
        case 2:
            return nums[Math.floor(Math.random() * nums.length)] //цифра
        case 3: 
            return symbols[Math.floor(Math.random() * symbols.length)] //спец символ
    }
}

function getPasswordParts(comandsLen) {
    const sequense = []
    while (sequense.length < 4) {
        let comand = Math.floor(Math.random() * 4)
        if (!sequense.includes(comand)) {
            sequense.push(comand)
        }
    }
    for (let iteration = comandsLen - 4; iteration > 0; iteration--) {
        sequense.push(Math.floor(Math.random() * 4))
    }
    return sequense
}

console.log(getPassword('one'))
console.log(getPassword(0))
console.log(getPassword(4))
console.log(getPassword(12))