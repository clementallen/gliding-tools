// 1. Open the Handicap pdf file from the BGA Ladder website
// 2. Copy all the aircraft
// 3. Paste list into `toSplit` variable
// 4. Sanitise string by removing unnecessary line breaks after hyphens and other characters.  Also check for HpH304SFES as that can be split
// 5. Output is a json object of handicaps
// 6. Create new handicaps file with the year in the filename (to avoid requesting the cached file from previous years)
// 7. node handicapListGenerator.js > ../assets/bgahandicaps-[yyyy].json
// 8. Update references to files across site
// 9. Profit

const toSplit = `AC-4A 83
AC-4B 83
AC-4C 85
Acro Twin 2 85
Acro Twin 3 89
Antares (18m) 111
Antares (20m) 114
Arcus 107
AS33 (15m) 104.5
AS33 (18m) 111.5
ASG29 (15m) 104
ASG29 (18m) 111
ASH30 117.5
ASG32 107
ASH25 113
ASH25 (25.6m) 114
ASH25 (26m) 115
ASH25 (27m) 115
ASH25EB28 116
ASH26 110
ASH31 (18m) 111
ASH31 (21m) 115
ASK13 67
ASK14 72
ASK16 60
ASK18 81
ASK21 85
ASK23 85
Astir CS 89
Astir Jeans 86
ASW12 105
ASW15 89
ASW17 106
ASW19a,b 93
ASW19club 90
ASW20 98
ASW20b,c 98
ASW20bl 102
ASW20 cl 101
ASW20f 98
ASW20FL 101
ASW20L 101
ASW22 (24m) 114
ASW22b 116
ASW22bl 117.5
ASW24 97
ASW24 (w) 97.5
ASW27a,b 104
ASW28 100
ASW28-18 (15m) 100
ASW28-18 (18m) 106
Bergfalke 4 69
Bergfalke 65
BG135 74
Blanik 65
Bocian 65
Calif A21 100
Capstan 62
Cirrus (17.7m) 94
Cirrus (18.8m) 96
Club Libelle 86
Cobra 15 85
Dart 15 76
Dart 17r 83
DG300 club (fixed) 93
DG100/101 90
DG100/101 (fixed) 88
DG200 97
DG202 (15m) 97
DG202 (17m) 101
DG300 club (retractable) 95
DG300 96
DG300 (w) 96.5
DG303 97
DG400 (15m) 97
DG400 (17m) 101
DG500/505 trainer (fixed gear) 90
DG500/505 trainer (retractable) 92
DG500/505 Orion (20m) 98
DG500/505 (20m) flapped 100
DG500/505 (22m) 104
DG600 (17m) 105
DG600 (15m) 99
DG600 (15m-w) 99.5
DG600 (18m) 107
DG800 (18m) 110
DG800 (15m) 103
DG800 (15m-w) 103.5
DG1000 (20m) 102
DG1000 (18) 96
DG1000 (18) (fixed gear) 94
Diamant 18 100
Diamant (16.5m) 89
Discus 98
Discus (w) 98.5
Discus 2 100
Discus 2 (w) & 2c (15m) 100.5
Discus 2c (18m) 106
Discus 2c FES (15m) 99.5
Discus 2c FES (18m) 105
Duo Discus 101
Duo Discus (w) 101.5
Duo Discus X (700kg) 101.5
Duo DiscusX (750kg) 102
Duo Discus XL 102
Eagle 68
Fauvette 74
FK3 89
Foka 4 81
Foka 5 83
Glasflugel 304 99
Glasflugel 604 107
Grob 102 85
Grob 109b 70
Grunau Baby 55
Hornet 90
HpH304SFES 109
HpH304S 110
HpH304TS 107
Iris 80
IS28b 80
IS29d 83
IS32 101
Janus a,b 96
Janus c (fixed gear) 98
Janus c (retractable) 100
Jaskolka 69
JS1a,b 111
JS1c (18m) 111
JS1c (21m) 118
JP15-36a 87
JS3 (15m) 104.5
JS3 (18m) 111.5
K-2 64
K-6cr 76
K-6e 81
K-7 64
K-8 69
Kestrel 17 98
Kestrel 19 102
Kestrel 20 104
Kestrel 22 107
Kite 2a 60
Kranich 58
Lak12 105
Lak17a (15m) 103
Lak17a (15m-w) 103.5
Lak17a (18m) 109
Lak17b (15m) 104
Lak17b (18m) 110
Lak17b FES (15m) 103
Lak17b FES (18m) 109
Lak 17b Mini FES (13.5m) 96
Lak 19 (15m) 99.5
Lak 19 (15m-w) 100
Lak 19 (18m) 106
Libelle 301 96
LS1 (0,c,d) 88
LS1-0 (fixed) 85
LS1f 91
LS3 (15m) 98
LS3 (17m) 102
LS4 96
LS6 (15m) 101
LS6 (15m-w) 101.5
LS6c (17.5m) 106
LS6c (18m) 107
LS7 97
LS7 (w) 97.5
LS8 (15m) 100
LS8 Neo (15m) 100.5
LS8-18 (18m) 106
LS-10 (18m) 110
LS-10 (15m) 104
L-Spatz 72
ME7 83
M 100S 72
M 200 74
Marianne 91
Meise 62
Minimoa 70
Mini Nimbus 98
Mistral c (fixed) 88
Mosquito a,b 98
Moswey 3 69
Moswey 4 72
Nimbus 3 (25.5m) 115
Nimbus 2,b,c 106
Nimbus 2cs (23.5m) 111
Nimbus 3 (24.5m) 114
Nimbus 3 (25.5m) 115
Nimbus 3d (24.6m) 113
Nimbus 3d (25.6m) 114
Nimbus 4 117.5
Nimbus 4d 115
Oly 403 76
Oly 463 76
Olympia 2 62
Olympia 419 78
Pegasus Club (fixed gear) 92
Pegasus 95
Phoebus 17 93
Pik20 96
Pilatus B4 (fixed gear) 80
Pilatus B4 (retractable) 82
Prefect 56
PW 5 81
Rhoensperber 57
Salto (15.5m-w) 87
SB 5e (16.5m) 83
SD 3/15 81
SF 26 76
SF 27a 82
SF 27b 83
SFH 34 85
SHK-1 89
Sie3 81
Silene 88
Silent 2 Electro 89
Sky 72
Skylark 2 67
Skylark 3 77
Skylark 4 78
Speed Astir 96
Sport Vega 89
Std. Cirrus 90
Std. Cirrus (16m) 92
Std. Libelle 89
Stemme S10 104
Super Blanik 72
Superfalke 64
Swallow 62
SZD 59 92
SZD 30 Pirat 78
SZD 38 Jantar 1 102
SZD 42 Jantar 2 106
SZD 41 Standard Jantar 92
SZD 50 Puchacz 80
SZD 51 Junior 83
SZD 55 98
SZD 56 103
SZD-54-2 Perkoz (20m) 93
SZD-54-2 Perkoz (17.5m) 87
T21 50
T53 69
Tandem Falke 60
Torva 83
Twin Astir 87
Vega (17m) 101
Vega (15m) 97
Ventus a,b (16.6m) 104
Ventus a,b,c (15m) 101
Ventus c (17.6m) 106
Ventus 2a,b,ax 104
Ventus 2c,cx,cxa (15m) 104
Ventus 2cxa FES (15m) 103
Ventus 2c (18m) 109.5
Ventus 2cx (18m) 110
Ventus 2cxa (18m) 111
Ventus 2cxa FES (18m) 110
Ventus 3S (15m) 104.5
Ventus 3S (18m) 111.5
Ventus 3S T (15m) 104.5
Ventus 3S T (18m) 111.5
Ventus 3S FES (15m) 103.5
Ventus 3S FES (18m) 110.5
Ventus 3P T (18m) 111
Ventus 3P M (18m) 111
Viking 85
Weihe 67
WA22 72
WA28 86
Zugvogel 3b 83`;

const splitByLinebreaks = toSplit.split('\n').sort();

const handicapsObject = splitByLinebreaks
    .map((aircraft) => {
        const items = aircraft.split(' ');
        const Handicap = items.pop();
        const GliderType = items.join(' ').toUpperCase();
        return { GliderType, Handicap };
    })
    .sort((a, b) => {
        const textA = a.GliderType.toUpperCase();
        const textB = b.GliderType.toUpperCase();
        return textA < textB ? -1 : textA > textB ? 1 : 0;
    });

console.log(JSON.stringify(handicapsObject, 0, 4));
