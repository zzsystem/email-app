import en from './en.json';
import hu from './hu.json';

const langs = { en, hu };

export const __ = (path, lang) => {
    return langs[lang][path] ?? path;
};

export const useLang = (lang) => {
    return { __: (path) => __(path, lang) };
};
