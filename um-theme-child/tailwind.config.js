module.exports = {
    purge: {
        enabled: true,
        content: ['./src/**/*.html']
    },
    theme: {
        screens: {
            xs: '0px',
            maxxs: {'max': '575px'},
            sm: '576px',
            maxsm: {'max': '767px'},
            onlysm: {'min': '576px', 'max': '767px'},
            md: '768px',
            maxmd: {'max': '991px'},
            onlymd: {'min': '768px', 'max': '991px'},
            lg: '992px',
            maxlg: {'max': '1199px'},
            onlylg: {'min': '768px', 'max': '1199px'},
            xl: '1200px',
            maxxl: {'max': '1599px'},
            onlyxl: {'min': '1200px', 'max': '1599px'},
            xxl: '1600px',
        },
        scale: {
            '0': '0',
            '5': '.5',
            '10': '.10',
            '15': '.15',
            '20': '.20',
            '25': '.25',
            '30': '.30',
            '35': '.35',
            '40': '.40',
            '45': '.45',
            '50': '.5',
            '55': '.55',
            '60': '.60',
            '65': '.65',
            '70': '.70',
            '75': '.75',
            '80': '.80',
            '85': '.85',
            '90': '.9',
            '95': '.95',
            '100': '1',
            '105': '1.05',
            '110': '1.1',
            '125': '1.25',
            '150': '1.5',
            '200': '2',
        },
        /*fontFamily: {
            'family-headline': 'circe-slab-a, Open Sans, sans-serif',
            'family-regular': 'circe-rounded, Open Sans, sans-serif',
            'family-bold': 'circe-rounded, Open Sans, sans-serif',
            'family-footer': 'raleway, Open Sans, sans-serif',
        },*/
        fontSize: {
            h1: ['34px', '41px'],
            h2: ['18px', '24px'],
            h3: ['22px', '28px'],
            default: ['18px', '22px'],
            small: ['14px', '18px'],
        },
        extend: {
            colors: {
                darkblue    : '#101340',

            },
            
            transitionProperty: {
                'background': 'background-color',
            }
        },
    },
    variants: [],
    plugins: []
}
