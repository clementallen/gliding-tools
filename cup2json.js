const fs = require('fs');
const CUPParser = require('cup-parser');

const { waypoints } = CUPParser.parse(
    fs.readFileSync('./assets/bga_2024.cup', 'utf8'),
);

const reduced = waypoints.map(({ name, code: trigraph }) => {
    return { name, trigraph };
});

console.log(JSON.stringify(reduced, 0, 4));
