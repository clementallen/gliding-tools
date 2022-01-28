const fs = require('fs');

const file = fs.readFileSync('./assets/bgahandicaps-2022.json');

const items = JSON.parse(file);

const sorted = items.sort((a, b) => (a.GliderType > b.GliderType ? 1 : b.GliderType > a.GliderType ? -1 : 0));

console.log(JSON.stringify(sorted));
