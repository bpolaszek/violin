<?php

namespace BenTools\Violin;

final class AsciiConverter
{
    /**
     * @param string $string
     * @return string
     */
    public static function convert(string $string, string $locale = null, ?string $replaceUnsupportedBy = ''): string
    {
        $map = self::DEFAULT_MAP;

        if (null !== $locale) {
            $locale = \strtolower($locale);
            $lang = \explode('_', \strtr($locale, ['-' => '_']))[0];
            $map = \array_replace($map, (self::SPECIFIC_MAPS[$lang] ?? []));
        }

        $asciized = \strtr($string, $map);

        if (null !== $replaceUnsupportedBy) {
            $asciized = \preg_replace('/[^\x20-\x7E]/u', $replaceUnsupportedBy, $asciized);
        }

        return $asciized;
    }

    const DEFAULT_MAP = [
        '°'  => 0,
        '₀'  => 0,
        '۰'  => 0,
        '０'  => 0,
        '¹'  => 1,
        '₁'  => 1,
        '۱'  => 1,
        '１'  => 1,
        '²'  => 2,
        '₂'  => 2,
        '۲'  => 2,
        '２'  => 2,
        '³'  => 3,
        '₃'  => 3,
        '۳'  => 3,
        '３'  => 3,
        '⁴'  => 4,
        '₄'  => 4,
        '۴'  => 4,
        '٤'  => 4,
        '４'  => 4,
        '⁵'  => 5,
        '₅'  => 5,
        '۵'  => 5,
        '٥'  => 5,
        '５'  => 5,
        '⁶'  => 6,
        '₆'  => 6,
        '۶'  => 6,
        '٦'  => 6,
        '６'  => 6,
        '⁷'  => 7,
        '₇'  => 7,
        '۷'  => 7,
        '７'  => 7,
        '⁸'  => 8,
        '₈'  => 8,
        '۸'  => 8,
        '８'  => 8,
        '⁹'  => 9,
        '₉'  => 9,
        '۹'  => 9,
        '９'  => 9,
        'à'  => 'a',
        'á'  => 'a',
        'ả'  => 'a',
        'ã'  => 'a',
        'ạ'  => 'a',
        'ă'  => 'a',
        'ắ'  => 'a',
        'ằ'  => 'a',
        'ẳ'  => 'a',
        'ẵ'  => 'a',
        'ặ'  => 'a',
        'â'  => 'a',
        'ấ'  => 'a',
        'ầ'  => 'a',
        'ẩ'  => 'a',
        'ẫ'  => 'a',
        'ậ'  => 'a',
        'ā'  => 'a',
        'ą'  => 'a',
        'å'  => 'a',
        'α'  => 'a',
        'ά'  => 'a',
        'ἀ'  => 'a',
        'ἁ'  => 'a',
        'ἂ'  => 'a',
        'ἃ'  => 'a',
        'ἄ'  => 'a',
        'ἅ'  => 'a',
        'ἆ'  => 'a',
        'ἇ'  => 'a',
        'ᾀ'  => 'a',
        'ᾁ'  => 'a',
        'ᾂ'  => 'a',
        'ᾃ'  => 'a',
        'ᾄ'  => 'a',
        'ᾅ'  => 'a',
        'ᾆ'  => 'a',
        'ᾇ'  => 'a',
        'ὰ'  => 'a',
        'ᾰ'  => 'a',
        'ᾱ'  => 'a',
        'ᾲ'  => 'a',
        'ᾳ'  => 'a',
        'ᾴ'  => 'a',
        'ᾶ'  => 'a',
        'ᾷ'  => 'a',
        'а'  => 'a',
        'أ'  => 'a',
        'အ'  => 'a',
        'ာ'  => 'a',
        'ါ'  => 'a',
        'ǻ'  => 'a',
        'ǎ'  => 'a',
        'ª'  => 'a',
        'ა'  => 'a',
        'अ'  => 'a',
        'ا'  => 'a',
        'ａ'  => 'a',
        'ä'  => 'a',
        'б'  => 'b',
        'β'  => 'b',
        'ب'  => 'b',
        'ဗ'  => 'b',
        'ბ'  => 'b',
        'ｂ'  => 'b',
        'ç'  => 'c',
        'ć'  => 'c',
        'č'  => 'c',
        'ĉ'  => 'c',
        'ċ'  => 'c',
        'ｃ'  => 'c',
        'ď'  => 'd',
        'ð'  => 'd',
        'đ'  => 'dj',
        'ƌ'  => 'd',
        'ȡ'  => 'd',
        'ɖ'  => 'd',
        'ɗ'  => 'd',
        'ᵭ'  => 'd',
        'ᶁ'  => 'd',
        'ᶑ'  => 'd',
        'д'  => 'd',
        'δ'  => 'd',
        'د'  => 'd',
        'ض'  => 'd',
        'ဍ'  => 'd',
        'ဒ'  => 'd',
        'დ'  => 'd',
        'ｄ'  => 'd',
        'é'  => 'e',
        'è'  => 'e',
        'ẻ'  => 'e',
        'ẽ'  => 'e',
        'ẹ'  => 'e',
        'ê'  => 'e',
        'ế'  => 'e',
        'ề'  => 'e',
        'ể'  => 'e',
        'ễ'  => 'e',
        'ệ'  => 'e',
        'ë'  => 'e',
        'ē'  => 'e',
        'ę'  => 'e',
        'ě'  => 'e',
        'ĕ'  => 'e',
        'ė'  => 'e',
        'ε'  => 'e',
        'έ'  => 'e',
        'ἐ'  => 'e',
        'ἑ'  => 'e',
        'ἒ'  => 'e',
        'ἓ'  => 'e',
        'ἔ'  => 'e',
        'ἕ'  => 'e',
        'ὲ'  => 'e',
        'е'  => 'e',
        'ё'  => 'e',
        'э'  => 'e',
        'є'  => 'e',
        'ə'  => 'e',
        'ဧ'  => 'e',
        'ေ'  => 'e',
        'ဲ'  => 'e',
        'ე'  => 'e',
        'ए'  => 'e',
        'إ'  => 'e',
        'ئ'  => 'e',
        'ｅ'  => 'e',
        'ф'  => 'f',
        'φ'  => 'f',
        'ف'  => 'f',
        'ƒ'  => 'f',
        'ფ'  => 'f',
        'ｆ'  => 'f',
        'ĝ'  => 'g',
        'ğ'  => 'g',
        'ġ'  => 'g',
        'ģ'  => 'g',
        'г'  => 'g',
        'ґ'  => 'g',
        'γ'  => 'g',
        'ဂ'  => 'g',
        'გ'  => 'g',
        'گ'  => 'g',
        'ｇ'  => 'g',
        'ĥ'  => 'h',
        'ħ'  => 'h',
        'η'  => 'h',
        'ή'  => 'h',
        'ح'  => 'h',
        'ه'  => 'h',
        'ဟ'  => 'h',
        'ှ'  => 'h',
        'ჰ'  => 'h',
        'ｈ'  => 'h',
        'í'  => 'i',
        'ì'  => 'i',
        'ỉ'  => 'i',
        'ĩ'  => 'i',
        'ị'  => 'i',
        'î'  => 'i',
        'ï'  => 'i',
        'ī'  => 'i',
        'ĭ'  => 'i',
        'į'  => 'i',
        'ı'  => 'i',
        'ι'  => 'i',
        'ί'  => 'i',
        'ϊ'  => 'i',
        'ΐ'  => 'i',
        'ἰ'  => 'i',
        'ἱ'  => 'i',
        'ἲ'  => 'i',
        'ἳ'  => 'i',
        'ἴ'  => 'i',
        'ἵ'  => 'i',
        'ἶ'  => 'i',
        'ἷ'  => 'i',
        'ὶ'  => 'i',
        'ῐ'  => 'i',
        'ῑ'  => 'i',
        'ῒ'  => 'i',
        'ῖ'  => 'i',
        'ῗ'  => 'i',
        'і'  => 'i',
        'ї'  => 'i',
        'и'  => 'i',
        'ဣ'  => 'i',
        'ိ'  => 'i',
        'ီ'  => 'i',
        'ည်' => 'i',
        'ǐ'  => 'i',
        'ი'  => 'i',
        'इ'  => 'i',
        'ی'  => 'i',
        'ｉ'  => 'i',
        'ĵ'  => 'j',
        'ј'  => 'j',
        'Ј'  => 'j',
        'ჯ'  => 'j',
        'ج'  => 'j',
        'ｊ'  => 'j',
        'ķ'  => 'k',
        'ĸ'  => 'k',
        'к'  => 'k',
        'κ'  => 'k',
        'Ķ'  => 'k',
        'ق'  => 'k',
        'ك'  => 'k',
        'က'  => 'k',
        'კ'  => 'k',
        'ქ'  => 'k',
        'ک'  => 'k',
        'ｋ'  => 'k',
        'ł'  => 'l',
        'ľ'  => 'l',
        'ĺ'  => 'l',
        'ļ'  => 'l',
        'ŀ'  => 'l',
        'л'  => 'l',
        'λ'  => 'l',
        'ل'  => 'l',
        'လ'  => 'l',
        'ლ'  => 'l',
        'ｌ'  => 'l',
        'м'  => 'm',
        'μ'  => 'm',
        'م'  => 'm',
        'မ'  => 'm',
        'მ'  => 'm',
        'ｍ'  => 'm',
        'ñ'  => 'n',
        'ń'  => 'n',
        'ň'  => 'n',
        'ņ'  => 'n',
        'ŉ'  => 'n',
        'ŋ'  => 'n',
        'ν'  => 'n',
        'н'  => 'n',
        'ن'  => 'n',
        'န'  => 'n',
        'ნ'  => 'n',
        'ｎ'  => 'n',
        'ó'  => 'o',
        'ò'  => 'o',
        'ỏ'  => 'o',
        'õ'  => 'o',
        'ọ'  => 'o',
        'ô'  => 'o',
        'ố'  => 'o',
        'ồ'  => 'o',
        'ổ'  => 'o',
        'ỗ'  => 'o',
        'ộ'  => 'o',
        'ơ'  => 'o',
        'ớ'  => 'o',
        'ờ'  => 'o',
        'ở'  => 'o',
        'ỡ'  => 'o',
        'ợ'  => 'o',
        'ø'  => 'o',
        'ō'  => 'o',
        'ő'  => 'o',
        'ŏ'  => 'o',
        'ο'  => 'o',
        'ὀ'  => 'o',
        'ὁ'  => 'o',
        'ὂ'  => 'o',
        'ὃ'  => 'o',
        'ὄ'  => 'o',
        'ὅ'  => 'o',
        'ὸ'  => 'o',
        'ό'  => 'o',
        'о'  => 'o',
        'و'  => 'o',
        'θ'  => 'o',
        'ို' => 'o',
        'ǒ'  => 'o',
        'ǿ'  => 'o',
        'º'  => 'o',
        'ო'  => 'o',
        'ओ'  => 'o',
        'ｏ'  => 'o',
        'ö'  => 'o',
        'п'  => 'p',
        'π'  => 'p',
        'ပ'  => 'p',
        'პ'  => 'p',
        'پ'  => 'p',
        'ｐ'  => 'p',
        'ყ'  => 'q',
        'ｑ'  => 'q',
        'ŕ'  => 'r',
        'ř'  => 'r',
        'ŗ'  => 'r',
        'р'  => 'r',
        'ρ'  => 'r',
        'ر'  => 'r',
        'რ'  => 'r',
        'ｒ'  => 'r',
        'ś'  => 's',
        'š'  => 's',
        'ş'  => 's',
        'с'  => 's',
        'σ'  => 's',
        'ș'  => 's',
        'ς'  => 's',
        'س'  => 's',
        'ص'  => 's',
        'စ'  => 's',
        'ſ'  => 's',
        'ს'  => 's',
        'ｓ'  => 's',
        'ť'  => 't',
        'ţ'  => 't',
        'т'  => 't',
        'τ'  => 't',
        'ț'  => 't',
        'ت'  => 't',
        'ط'  => 't',
        'ဋ'  => 't',
        'တ'  => 't',
        'ŧ'  => 't',
        'თ'  => 't',
        'ტ'  => 't',
        'ｔ'  => 't',
        'ú'  => 'u',
        'ù'  => 'u',
        'ủ'  => 'u',
        'ũ'  => 'u',
        'ụ'  => 'u',
        'ư'  => 'u',
        'ứ'  => 'u',
        'ừ'  => 'u',
        'ử'  => 'u',
        'ữ'  => 'u',
        'ự'  => 'u',
        'û'  => 'u',
        'ū'  => 'u',
        'ů'  => 'u',
        'ű'  => 'u',
        'ŭ'  => 'u',
        'ų'  => 'u',
        'µ'  => 'u',
        'у'  => 'u',
        'ဉ'  => 'u',
        'ု'  => 'u',
        'ူ'  => 'u',
        'ǔ'  => 'u',
        'ǖ'  => 'u',
        'ǘ'  => 'u',
        'ǚ'  => 'u',
        'ǜ'  => 'u',
        'უ'  => 'u',
        'उ'  => 'u',
        'ｕ'  => 'u',
        'ў'  => 'u',
        'ü'  => 'u',
        'в'  => 'v',
        'ვ'  => 'v',
        'ϐ'  => 'v',
        'ｖ'  => 'v',
        'ŵ'  => 'w',
        'ω'  => 'w',
        'ώ'  => 'w',
        'ဝ'  => 'w',
        'ွ'  => 'w',
        'ｗ'  => 'w',
        'χ'  => 'x',
        'ξ'  => 'x',
        'ｘ'  => 'x',
        'ý'  => 'y',
        'ỳ'  => 'y',
        'ỷ'  => 'y',
        'ỹ'  => 'y',
        'ỵ'  => 'y',
        'ÿ'  => 'y',
        'ŷ'  => 'y',
        'й'  => 'y',
        'ы'  => 'y',
        'υ'  => 'y',
        'ϋ'  => 'y',
        'ύ'  => 'y',
        'ΰ'  => 'y',
        'ي'  => 'y',
        'ယ'  => 'y',
        'ｙ'  => 'y',
        'ź'  => 'z',
        'ž'  => 'z',
        'ż'  => 'z',
        'з'  => 'z',
        'ζ'  => 'z',
        'ز'  => 'z',
        'ဇ'  => 'z',
        'ზ'  => 'z',
        'ｚ'  => 'z',
        'ع'  => 'aa',
        'आ'  => 'aa',
        'آ'  => 'aa',
        'æ'  => 'ae',
        'ǽ'  => 'ae',
        'ऐ'  => 'ai',
        'ч'  => 'ch',
        'ჩ'  => 'ch',
        'ჭ'  => 'ch',
        'چ'  => 'ch',
        'ђ'  => 'dj',
        'џ'  => 'dz',
        'ძ'  => 'dz',
        'ऍ'  => 'ei',
        'غ'  => 'gh',
        'ღ'  => 'gh',
        'ई'  => 'ii',
        'ĳ'  => 'ij',
        'х'  => 'kh',
        'خ'  => 'kh',
        'ხ'  => 'kh',
        'љ'  => 'lj',
        'њ'  => 'nj',
        'œ'  => 'oe',
        'ؤ'  => 'oe',
        'ऑ'  => 'oi',
        'ऒ'  => 'oii',
        'ψ'  => 'ps',
        'ш'  => 'sh',
        'შ'  => 'sh',
        'ش'  => 'sh',
        'щ'  => 'shch',
        'ß'  => 'ss',
        'ŝ'  => 'sx',
        'þ'  => 'th',
        'ϑ'  => 'th',
        'ث'  => 'th',
        'ذ'  => 'th',
        'ظ'  => 'th',
        'ц'  => 'ts',
        'ც'  => 'ts',
        'წ'  => 'ts',
        'ऊ'  => 'uu',
        'я'  => 'ya',
        'ю'  => 'yu',
        'ж'  => 'zh',
        'ჟ'  => 'zh',
        'ژ'  => 'zh',
        '©'  => '(c)',
        'Á'  => 'A',
        'À'  => 'A',
        'Ả'  => 'A',
        'Ã'  => 'A',
        'Ạ'  => 'A',
        'Ă'  => 'A',
        'Ắ'  => 'A',
        'Ằ'  => 'A',
        'Ẳ'  => 'A',
        'Ẵ'  => 'A',
        'Ặ'  => 'A',
        'Â'  => 'A',
        'Ấ'  => 'A',
        'Ầ'  => 'A',
        'Ẩ'  => 'A',
        'Ẫ'  => 'A',
        'Ậ'  => 'A',
        'Å'  => 'A',
        'Ā'  => 'A',
        'Ą'  => 'A',
        'Α'  => 'A',
        'Ά'  => 'A',
        'Ἀ'  => 'A',
        'Ἁ'  => 'A',
        'Ἂ'  => 'A',
        'Ἃ'  => 'A',
        'Ἄ'  => 'A',
        'Ἅ'  => 'A',
        'Ἆ'  => 'A',
        'Ἇ'  => 'A',
        'ᾈ'  => 'A',
        'ᾉ'  => 'A',
        'ᾊ'  => 'A',
        'ᾋ'  => 'A',
        'ᾌ'  => 'A',
        'ᾍ'  => 'A',
        'ᾎ'  => 'A',
        'ᾏ'  => 'A',
        'Ᾰ'  => 'A',
        'Ᾱ'  => 'A',
        'Ὰ'  => 'A',
        'ᾼ'  => 'A',
        'А'  => 'A',
        'Ǻ'  => 'A',
        'Ǎ'  => 'A',
        'Ａ'  => 'A',
        'Ä'  => 'A',
        'Б'  => 'B',
        'Β'  => 'B',
        'ब'  => 'B',
        'Ｂ'  => 'B',
        'Ç'  => 'C',
        'Ć'  => 'C',
        'Č'  => 'C',
        'Ĉ'  => 'C',
        'Ċ'  => 'C',
        'Ｃ'  => 'C',
        'Ď'  => 'D',
        'Ð'  => 'D',
        'Đ'  => 'D',
        'Ɖ'  => 'D',
        'Ɗ'  => 'D',
        'Ƌ'  => 'D',
        'ᴅ'  => 'D',
        'ᴆ'  => 'D',
        'Д'  => 'D',
        'Δ'  => 'D',
        'Ｄ'  => 'D',
        'É'  => 'E',
        'È'  => 'E',
        'Ẻ'  => 'E',
        'Ẽ'  => 'E',
        'Ẹ'  => 'E',
        'Ê'  => 'E',
        'Ế'  => 'E',
        'Ề'  => 'E',
        'Ể'  => 'E',
        'Ễ'  => 'E',
        'Ệ'  => 'E',
        'Ë'  => 'E',
        'Ē'  => 'E',
        'Ę'  => 'E',
        'Ě'  => 'E',
        'Ĕ'  => 'E',
        'Ė'  => 'E',
        'Ε'  => 'E',
        'Έ'  => 'E',
        'Ἐ'  => 'E',
        'Ἑ'  => 'E',
        'Ἒ'  => 'E',
        'Ἓ'  => 'E',
        'Ἔ'  => 'E',
        'Ἕ'  => 'E',
        'Ὲ'  => 'E',
        'Е'  => 'E',
        'Ё'  => 'E',
        'Э'  => 'E',
        'Є'  => 'E',
        'Ə'  => 'E',
        'Ｅ'  => 'E',
        'Ф'  => 'F',
        'Φ'  => 'F',
        'Ｆ'  => 'F',
        'Ğ'  => 'G',
        'Ġ'  => 'G',
        'Ģ'  => 'G',
        'Г'  => 'G',
        'Ґ'  => 'G',
        'Γ'  => 'G',
        'Ｇ'  => 'G',
        'Η'  => 'H',
        'Ή'  => 'H',
        'Ħ'  => 'H',
        'Ｈ'  => 'H',
        'Í'  => 'I',
        'Ì'  => 'I',
        'Ỉ'  => 'I',
        'Ĩ'  => 'I',
        'Ị'  => 'I',
        'Î'  => 'I',
        'Ï'  => 'I',
        'Ī'  => 'I',
        'Ĭ'  => 'I',
        'Į'  => 'I',
        'İ'  => 'I',
        'Ι'  => 'I',
        'Ί'  => 'I',
        'Ϊ'  => 'I',
        'Ἰ'  => 'I',
        'Ἱ'  => 'I',
        'Ἳ'  => 'I',
        'Ἴ'  => 'I',
        'Ἵ'  => 'I',
        'Ἶ'  => 'I',
        'Ἷ'  => 'I',
        'Ῐ'  => 'I',
        'Ῑ'  => 'I',
        'Ὶ'  => 'I',
        'И'  => 'I',
        'І'  => 'I',
        'Ї'  => 'I',
        'Ǐ'  => 'I',
        'ϒ'  => 'I',
        'Ｉ'  => 'I',
        'Ｊ'  => 'J',
        'К'  => 'K',
        'Κ'  => 'K',
        'Ｋ'  => 'K',
        'Ĺ'  => 'L',
        'Ł'  => 'L',
        'Л'  => 'L',
        'Λ'  => 'L',
        'Ļ'  => 'L',
        'Ľ'  => 'L',
        'Ŀ'  => 'L',
        'ल'  => 'L',
        'Ｌ'  => 'L',
        'М'  => 'M',
        'Μ'  => 'M',
        'Ｍ'  => 'M',
        'Ń'  => 'N',
        'Ñ'  => 'N',
        'Ň'  => 'N',
        'Ņ'  => 'N',
        'Ŋ'  => 'N',
        'Н'  => 'N',
        'Ν'  => 'N',
        'Ｎ'  => 'N',
        'Ó'  => 'O',
        'Ò'  => 'O',
        'Ỏ'  => 'O',
        'Õ'  => 'O',
        'Ọ'  => 'O',
        'Ô'  => 'O',
        'Ố'  => 'O',
        'Ồ'  => 'O',
        'Ổ'  => 'O',
        'Ỗ'  => 'O',
        'Ộ'  => 'O',
        'Ơ'  => 'O',
        'Ớ'  => 'O',
        'Ờ'  => 'O',
        'Ở'  => 'O',
        'Ỡ'  => 'O',
        'Ợ'  => 'O',
        'Ø'  => 'O',
        'Ō'  => 'O',
        'Ő'  => 'O',
        'Ŏ'  => 'O',
        'Ο'  => 'O',
        'Ό'  => 'O',
        'Ὀ'  => 'O',
        'Ὁ'  => 'O',
        'Ὂ'  => 'O',
        'Ὃ'  => 'O',
        'Ὄ'  => 'O',
        'Ὅ'  => 'O',
        'Ὸ'  => 'O',
        'О'  => 'O',
        'Θ'  => 'O',
        'Ө'  => 'O',
        'Ǒ'  => 'O',
        'Ǿ'  => 'O',
        'Ｏ'  => 'O',
        'Ö'  => 'O',
        'П'  => 'P',
        'Π'  => 'P',
        'Ｐ'  => 'P',
        'Ｑ'  => 'Q',
        'Ř'  => 'R',
        'Ŕ'  => 'R',
        'Р'  => 'R',
        'Ρ'  => 'R',
        'Ŗ'  => 'R',
        'Ｒ'  => 'R',
        'Ş'  => 'S',
        'Ŝ'  => 'S',
        'Ș'  => 'S',
        'Š'  => 'S',
        'Ś'  => 'S',
        'С'  => 'S',
        'Σ'  => 'S',
        'Ｓ'  => 'S',
        'Ť'  => 'T',
        'Ţ'  => 'T',
        'Ŧ'  => 'T',
        'Ț'  => 'T',
        'Т'  => 'T',
        'Τ'  => 'T',
        'Ｔ'  => 'T',
        'Ú'  => 'U',
        'Ù'  => 'U',
        'Ủ'  => 'U',
        'Ũ'  => 'U',
        'Ụ'  => 'U',
        'Ư'  => 'U',
        'Ứ'  => 'U',
        'Ừ'  => 'U',
        'Ử'  => 'U',
        'Ữ'  => 'U',
        'Ự'  => 'U',
        'Û'  => 'U',
        'Ū'  => 'U',
        'Ů'  => 'U',
        'Ű'  => 'U',
        'Ŭ'  => 'U',
        'Ų'  => 'U',
        'У'  => 'U',
        'Ǔ'  => 'U',
        'Ǖ'  => 'U',
        'Ǘ'  => 'U',
        'Ǚ'  => 'U',
        'Ǜ'  => 'U',
        'Ｕ'  => 'U',
        'Ў'  => 'U',
        'Ü'  => 'U',
        'В'  => 'V',
        'Ｖ'  => 'V',
        'Ω'  => 'W',
        'Ώ'  => 'W',
        'Ŵ'  => 'W',
        'Ｗ'  => 'W',
        'Χ'  => 'X',
        'Ξ'  => 'X',
        'Ｘ'  => 'X',
        'Ý'  => 'Y',
        'Ỳ'  => 'Y',
        'Ỷ'  => 'Y',
        'Ỹ'  => 'Y',
        'Ỵ'  => 'Y',
        'Ÿ'  => 'Y',
        'Ῠ'  => 'Y',
        'Ῡ'  => 'Y',
        'Ὺ'  => 'Y',
        'Ύ'  => 'Y',
        'Ы'  => 'Y',
        'Й'  => 'Y',
        'Υ'  => 'Y',
        'Ϋ'  => 'Y',
        'Ŷ'  => 'Y',
        'Ｙ'  => 'Y',
        'Ź'  => 'Z',
        'Ž'  => 'Z',
        'Ż'  => 'Z',
        'З'  => 'Z',
        'Ζ'  => 'Z',
        'Ｚ'  => 'Z',
        'Æ'  => 'AE',
        'Ǽ'  => 'AE',
        'Ч'  => 'Ch',
        'Ђ'  => 'Dj',
        'Џ'  => 'Dz',
        'Ĝ'  => 'Gx',
        'Ĥ'  => 'Hx',
        'Ĳ'  => 'Ij',
        'Ĵ'  => 'Jx',
        'Х'  => 'Kh',
        'Љ'  => 'Lj',
        'Њ'  => 'Nj',
        'Œ'  => 'Oe',
        'Ψ'  => 'Ps',
        'Ш'  => 'Sh',
        'Щ'  => 'Shch',
        'ẞ'  => 'Ss',
        'Þ'  => 'Th',
        'Ц'  => 'Ts',
        'Я'  => 'Ya',
        'Ю'  => 'Yu',
        'Ж'  => 'Zh',
        "\xC2\xA0" => ' ',
        "\xE2\x80\x80" => ' ',
        "\xE2\x80\x81" => ' ',
        "\xE2\x80\x82" => ' ',
        "\xE2\x80\x83" => ' ',
        "\xE2\x80\x84" => ' ',
        "\xE2\x80\x85" => ' ',
        "\xE2\x80\x86" => ' ',
        "\xE2\x80\x87" => ' ',
        "\xE2\x80\x88" => ' ',
        "\xE2\x80\x89" => ' ',
        "\xE2\x80\x8A" => ' ',
        "\xE2\x80\xAF" => ' ',
        "\xE2\x81\x9F" => ' ',
        "\xE3\x80\x80" => ' ',
        "\xEF\xBE\xA0" => ' ',
    ];
    const SPECIFIC_MAPS = [
        'de' => [
            'ä' => 'ae',
            'ö' => 'oe',
            'ü' => 'ue',
            'Ä' => 'AE',
            'Ö' => 'OE',
            'Ü' => 'UE',
        ],
        'bg' => [
            'х' => 'h',
            'Х' => 'H',
            'щ' => 'sht',
            'Щ' => 'SHT',
            'ъ' => 'a',
            'Ъ' => 'А',
            'ь' => 'y',
            'Ь' => 'Y',
        ],
    ];
}
