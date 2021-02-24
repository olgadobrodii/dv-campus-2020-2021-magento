/**
 * grunt exec:olhad_luma_en_us && grunt less:olhad_luma_en_us && grunt watch:olhad_luma_en_us
 * grunt exec:olhad_luma_uk_ua && grunt less:olhad_luma_uk_ua && grunt watch:olhad_luma_uk_ua
 */
module.exports = {
    olhad_luma_en_us: {
        area: 'frontend',
        name: 'OlhaD/luma',
        locale: 'en_US',
        files: [
            'css/styles-m',
            'css/styles-l'
        ],
        dsl: 'less'
    },
    olhad_luma_uk_ua: {
        area: 'frontend',
        name: 'OlhaD/luma',
        locale: 'uk_UA',
        files: [
            'css/styles-m',
            'css/styles-l'
        ],
        dsl: 'less'
    },
};
