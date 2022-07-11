<?php

return [
    'boxes' => [
        [
            'header' => 'Kendini Dene',
            'class' => 'box1',
            'content' => [
                'Bu ortam üniversite sınavlarına (TYT,AYT) hazırlanan kişiler için hazırlanmıştır. Sınav ortamına en yakın durumu verebilmeyi hedeflemektedir.',
            ],
            'link' => [
                'text' => 'Soru Çöz',
                'url' => '/aaa',
            ],
        ],
        [
            'header' => 'Gelişimini İzle',
            'class' => 'box2',
            'content' => [
                'Kayıt olmanız durumunda zamana göre gelişiminizi takip edebilirsiniz.',
            ],
            'link' => false,
        ],
        [
            'header' => 'Katkıda Bulun',
            'class' => 'box3',
            'content' => [
                'Soru ve/veya yeni sınav ekleyerek katkıda bulunabilirsiniz.',
            ],
            'link' => [
                'text' => 'Soru Ekle',
                'url' => '/soru-add',
            ],
        ],
    ],

    'gunluk' => [
        [
            'tur' => 'M',
            'header' => 'Günün Matematk Sorusu',
            'image' => 'MathPromo.svg',
            'motto' => 'Matematiğin eğlence olduğunu düşünenlere',
        ],
        [
            'tur' => 'F',
            'header' => 'Günün Fizik Sorusu',
            'image' => 'PhysicsPromo.svg',
            'motto' => 'Aslonan fiziktir',
        ],
        [
            'tur' => 'T',
            'header' => 'Günün Türkçe Sorusu',
            'image' => 'TurkcePromo.svg',
            'motto' => 'Herşey anlama ile başlar',
        ],
    ],
];
