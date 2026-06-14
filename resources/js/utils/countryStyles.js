export function getCountryStyle(code) {

    const map = {

        ARG: {
            gradient: 'from-sky-100 via-white to-cyan-100',
            border: 'border-sky-300',
            glow: 'shadow-sky-100',
            accent: 'bg-sky-500'
        },

        BRA: {
            gradient: 'from-green-100 via-yellow-50 to-yellow-200',
            border: 'border-yellow-300',
            glow: 'shadow-yellow-100',
            accent: 'bg-yellow-500'
        },

        MEX: {
            gradient: 'from-green-100 via-white to-red-100',
            border: 'border-green-300',
            glow: 'shadow-green-100',
            accent: 'bg-green-500'
        },

        FRA: {
            gradient: 'from-blue-100 via-white to-red-100',
            border: 'border-blue-300',
            glow: 'shadow-blue-100',
            accent: 'bg-blue-500'
        },

        GER: {
            gradient: 'from-gray-200 via-yellow-50 to-red-100',
            border: 'border-gray-400',
            glow: 'shadow-gray-200',
            accent: 'bg-gray-700'
        },

        ESP: {
            gradient: 'from-red-100 via-yellow-50 to-red-200',
            border: 'border-red-300',
            glow: 'shadow-red-100',
            accent: 'bg-red-500'
        }
    };

    return map[code] || {
        gradient: 'from-slate-100 via-white to-gray-100',
        border: 'border-slate-300',
        glow: 'shadow-slate-100',
        accent: 'bg-slate-500'
    };
}