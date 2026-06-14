import { useEffect, useState } from 'react';
import { api } from '../api/axios';
import { Link } from 'react-router-dom';
import { getCountryStyle } from '../utils/countryStyles';
import { countryRegions } from '../utils/countryRegions';

export default function CountryList() {
  const [countries, setCountries] = useState([]);
  const [loading, setLoading] = useState(true);
  const [filter, setFilter] = useState('all');

  useEffect(() => {
    api
      .get('/countries')
      .then((res) => setCountries(res.data))
      .catch((err) => console.error('Error:', err))
      .finally(() => setLoading(false));
  }, []);

  if (loading) {
    return (
      <div className="text-center py-24 text-slate-500">Cargando países...</div>
    );
  }

  // FILTER LOGIC
  const filteredCountries = countries.filter((country) => {
    const owned = country.stickers?.filter((s) => s.is_owned).length || 0;
    const hasShield = country.stickers?.some(
      (s) => s.name.includes('Escudo') && s.is_owned
    );
    const hasSquad = country.stickers?.some(
      (s) => s.name.includes('Plantel') && s.is_owned
    );

    switch (filter) {
      case 'almost':
        return owned >= 15 && owned < 20;
      case 'completed':
        return owned === 20;
      case 'missing-shield':
        return !hasShield;
      case 'missing-squad':
        return !hasSquad;
      case 'america':
      case 'europe':
      case 'africa':
      case 'asia':
      case 'oceania':
        return countryRegions[country.code] === filter;
      default:
        return true;
    }
  });

  return (
    <div className="space-y-8">
      {/* HEADER */}
      <div className="space-y-4">
        <div>
          <h1 className="text-4xl font-black tracking-tight text-slate-950 flex items-center gap-3">
            🌍 Países Clasificados 2026
          </h1>
          <p className="mt-3 max-w-2xl text-base text-slate-600">
            {countries.length} selecciones • 20 estampitas cada una • Completa todos los álbumes
          </p>
        </div>
      </div>

      {/* FILTER BAR */}
      <div className="sticky top-16 z-20">
        <div className="flex flex-wrap gap-3 rounded-4xl border border-slate-200 bg-white/95 p-4 shadow-sm backdrop-blur-sm">
          {[
            ['all', '🌐 Todos'],
            ['almost', '🔥 Casi completos'],
            ['completed', '✅ Completados'],
            ['missing-shield', '🛡️ Falta escudo'],
            ['missing-squad', '👤 Falta equipo'],
            ['america', '🗝️ América'],
            ['europe', '💷 Europa'],
            ['africa', '🍂 África'],
            ['asia', '🏵️ Asia'],
            ['oceania', '🎏 Oceanía'],
          ].map(([value, label]) => (
            <button
              key={value}
              onClick={() => setFilter(value)}
              className={`rounded-full px-4 py-2 text-xs font-black uppercase tracking-widest whitespace-nowrap transition-all duration-200 ${
                filter === value
                  ? 'bg-sky-600 text-white shadow-lg'
                  : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
              }`}
            >
              {label}
            </button>
          ))}
        </div>
      </div>

      {/* COUNTRIES GRID */}
      <div className="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
        {filteredCountries.map((country) => {
          const owned = country.stickers?.filter((s) => s.is_owned).length || 0;
          const percent = Math.round((owned / 20) * 100);
          const completed = owned === 20;

          return (
            <Link
              key={country.code}
              to={`/countries/${country.code}`}
              className={`group relative overflow-hidden rounded-4xl border p-5 text-center transition-all duration-200 ${
                completed
                  ? 'border-emerald-200 bg-emerald-50 shadow-lg hover:shadow-xl'
                  : 'border-slate-200 bg-white hover:-translate-y-0.5 hover:border-sky-300 hover:shadow-lg'
              }`}
            >
              {/* FLAG */}
              <div className="text-5xl group-hover:scale-110 transition">{getFlag(country.code)}</div>

              {/* NAME */}
              <p className="mt-3 text-sm font-black text-slate-950">{country.name}</p>

              {/* PROGRESS */}
              <div className="mt-4 space-y-2">
                <div className="flex items-center justify-between text-xs">
                  <span className="font-semibold text-slate-600">{owned}/20</span>
                  <span className={`font-black ${completed ? 'text-emerald-600' : 'text-slate-500'}`}>
                    {percent}%
                  </span>
                </div>
                <div className="h-1.5 overflow-hidden rounded-full bg-slate-200">
                  <div
                    className={`h-full rounded-full transition-all duration-500 ${
                      completed ? 'bg-emerald-500' : 'bg-sky-500'
                    }`}
                    style={{ width: `${percent}%` }}
                  />
                </div>
              </div>

              {/* BADGE */}
              {completed && (
                <span className="mt-3 inline-block rounded-full bg-emerald-600 px-3 py-1 text-[10px] font-black uppercase tracking-widest text-white shadow-lg">
                  ✓ Completado
                </span>
              )}
            </Link>
          );
        })}
      </div>
    </div>
  );
}

// FLAGS
function getFlag(code) {
  const flags = {
    MEX: '🇲🇽',
    BRA: '🇧🇷',
    ARG: '🇦🇷',
    ESP: '🇪🇸',
    ENG: '🏴',
    FRA: '🇫🇷',
    GER: '🇩🇪',
    POR: '🇵🇹',
    NED: '🇳🇱',
    USA: '🇺🇸',
    CAN: '🇨🇦',
    JPN: '🇯🇵',
    KOR: '🇰🇷',
    AUS: '🇦🇺',
    MAR: '🇲🇦',
    SEN: '🇸🇳',
    EGY: '🇪🇬',
    COL: '🇨🇴',
    URU: '🇺🇾',
    BEL: '🇧🇪',
    CRO: '🇭🇷',
    SUI: '🇨🇭',
    SWE: '🇸🇪',
    TUR: '🇹🇷',
    NOR: '🇳🇴',
  };

  return flags[code] || '⚽';
}
