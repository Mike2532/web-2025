const users = [
    { id: 1, name: "Alice" },
    { id: 2, name: "Bob" },
    { id: 3, name: "Charlie" }
  ];

function getNames(users) {
    const names = []
    for (const user of users) {
        names.push(user['name'])
    }

    let ans = ''
    for (const name of names) {
        ans += '"' + name + '" '
    }
    console.log(ans)
}