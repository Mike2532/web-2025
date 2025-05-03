function isPrime(n) {
    for (let i = 2; i < n; i++) {
        if (n % i == 0) {
            return false
        }
    }
    return true
}

function isPrimeNumber(n) {
    let answer = 'Результат: '
    if (typeof n == 'number') {

        answer += n
        if (!isPrime(n)) {
            answer += ' не'
        }
        answer += ' простое число'
        return answer

    } else if (Array.isArray(n)) {

        const prime = []
        const notPrime = []
        for (let element of n) {
            if (typeof element == 'number') {
                (isPrime(element))
                    ? prime.push(element)
                    : notPrime.push(element)
            } else {
                return 'ошибка: фукнция принимает только числа'
            }
        }

        let arrSize = prime.length
        if (arrSize != 0) {
            for (let i = 0; i < arrSize; i++) {
                if ((i != 0) && (i != arrSize)) {
                    answer += ', '
                }
                answer += ' ' + prime[i]
            }
            answer += ' простые числа'
        }

        arrSize = notPrime.length
        if (arrSize != 0) {
            for (let i = 0; i < arrSize; i++) {
                if (i != arrSize) {
                    answer += ', '
                }
                answer += ' ' + notPrime[i]
            }
            answer += ' не простые числа'
        }

        return answer

    } else {
        return 'ошибка: фукнция принимает только числа'
    }
}

console.log(isPrimeNumber('one'))
console.log(isPrimeNumber([1, 'two']))
console.log(isPrimeNumber(3))
console.log(isPrimeNumber(4))
console.log(isPrimeNumber([3, 4, 5, 6, 7, 10, 11]))