import i18next from 'i18next';
import en from './en';
import vn from './vn';

i18next
    .init({
        interpolation: {
            // React already does escaping
            escapeValue: false,
        },
        lng: 'en', // 'en' | 'es'
        // Using simple hardcoded resources for simple example
        resources: {
            en: {
                translation: en,
            },
            vn: {
                translation: vn,
            },
        },
    })

export default i18next