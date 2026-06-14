export function getStickerStyle(sticker) {

    if (sticker.name.includes('Escudo')) {
        return {
            gradient: 'from-yellow-100 via-amber-50 to-yellow-200',
            border: 'border-yellow-300',
            glow: 'shadow-yellow-100',
            badge: 'bg-yellow-500',
            rarity: 'LEGEND'
        };
    }

    if (sticker.name.includes('Plantel')) {
        return {
            gradient: 'from-blue-100 via-sky-50 to-indigo-100',
            border: 'border-blue-300',
            glow: 'shadow-blue-100',
            badge: 'bg-blue-500',
            rarity: 'TEAM'
        };
    }

    if (sticker.section === 'panini') {
        return {
            gradient: 'from-orange-100 via-amber-50 to-yellow-100',
            border: 'border-orange-300',
            glow: 'shadow-orange-100',
            badge: 'bg-orange-500',
            rarity: 'OFFICIAL'
        };
    }

    if (sticker.section === 'cocacola') {
        return {
            gradient: 'from-red-100 via-rose-50 to-pink-100',
            border: 'border-red-300',
            glow: 'shadow-red-100',
            badge: 'bg-red-500',
            rarity: 'LIMITED'
        };
    }

    if (sticker.section === 'history') {
        return {
            gradient: 'from-purple-100 via-fuchsia-50 to-violet-100',
            border: 'border-purple-300',
            glow: 'shadow-purple-100',
            badge: 'bg-purple-500',
            rarity: 'ICONIC'
        };
    }

    return {
        gradient: 'from-slate-100 via-white to-gray-100',
        border: 'border-slate-300',
        glow: 'shadow-slate-100',
        badge: 'bg-slate-500',
        rarity: 'PLAYER'
    };
}