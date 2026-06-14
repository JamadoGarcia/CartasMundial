<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorldCup2026Seeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ Desactivar restricciones FK temporalmente (seguro en seeders)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('stickers')->truncate();
        DB::table('countries')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2️⃣ Países clasificados (48 equipos)
        $countries = [
            'MEX','RSA','KOR','CZE','BRA','MAR','HAI','SCO',
            'GER','CUW','CIV','ECU','BEL','EGY','IRN','NZL',
            'FRA','SEN','IRQ','NOR','POR','COD','UZB','COL',
            'CAN','BIH','QAT','SUI','USA','PAR','AUS','TUR',
            'NED','JPN','SWE','TUN','ESP','CPV','KSA','URU',
            'ARG','ALG','AUT','JOR','ENG','CRO','GHA','PAN'
        ];

        $stickerCounter = 1;
        foreach ($countries as $code) {
            DB::table('countries')->insert([
                'name' => $this->getCountryName($code),
                'code' => $code,
                'total_stickers' => 20,
                'created_at' => now(),
            ]);
            $countryId = DB::table('countries')->where('code', $code)->value('id');

            for ($i = 1; $i <= 20; $i++) {
                $name = "Jugador";
                if ($i === 1) $name = "Escudo / Logo";
                elseif ($i === 13) $name = "Plantel / Equipo";
                
                // Ejemplo de nombres específicos (puedes expandir esto después)
                if ($code === 'BEL' && $i === 1) $name = "Thibaut Courtois";
                if ($code === 'BEL' && $i === 2) $name = "Arthur Theate";

                DB::table('stickers')->insert([
                    'country_id' => $countryId,
                    'section' => 'country',
                    'number' => "{$code} {$i}",
                    'name' => $name,
                    'is_owned' => false,
                    'created_at' => now(),
                ]);
                $stickerCounter++;
            }
        }

        // 3️⃣ Panini Oficial (9 estampitas)
        $panini = [
            ['00', 'Portada Oficial'],
            ['FWC 1', 'FIFA World Cup 1'],
            ['FWC 2', 'FIFA World Cup 2'],
            ['FWC 3', 'FIFA World Cup 3'],
            ['FWC 4', 'FIFA World Cup 4'],
            ['FWC 5', 'FIFA World Cup 5'],
            ['FWC 6', 'FIFA World Cup 6'],
            ['FWC 7', 'FIFA World Cup 7'],
            ['FWC 8', 'FIFA World Cup 8'],
        ];
        foreach ($panini as [$num, $name]) {
            DB::table('stickers')->insert([
                'section' => 'panini',
                'number' => $num,
                'name' => $name,
                'is_owned' => false,
                'created_at' => now()
            ]);
        }

        // 4️⃣ Coca-Cola (14 estampitas)
        $cocacola = [
            'CC1' => 'Lamine Yamal',
            'CC2' => 'Joshua Kimmich',
            'CC3' => 'Harry Kane',
            'CC4' => 'Santiago Giménez',
            'CC5' => 'Josko Gvardiol',
            'CC6' => 'Federico Valverde',
            'CC7' => 'Jefferson Lerma',
            'CC8' => 'Enner Valencia',
            'CC9' => 'Gabriel Magalhaes',
            'CC10' => 'Virgil van Dijk',
            'CC11' => 'Alphonso Davies',
            'CC12' => 'Emiliano Martínez',
            'CC13' => 'Raúl Jiménez',
            'CC14' => 'Lautaro Martínez'
        ];
        foreach ($cocacola as $num => $name) {
            DB::table('stickers')->insert([
                'section' => 'cocacola',
                'number' => $num,
                'name' => $name,
                'is_owned' => false,
                'created_at' => now()
            ]);
        }

        // 5️⃣ Historia FIFA (11 estampitas) - Usamos prefijo interno para evitar colisiones
        $history = [
            'HIST_FWC_1' => 'Uruguay 1930 / Italia 1934 (Los inicios de la Copa)',
            'HIST_FWC_2' => 'Uruguay 1950 (El Maracanazo)',
            'HIST_FWC_3' => 'Alemania Federal 1954 (El Milagro de Berna)',
            'HIST_FWC_4' => 'Brasil 1962 (Bicampeonato de Pelé y Garrincha)',
            'HIST_FWC_5' => 'Alemania Federal 1974 (Consagración frente a la Naranja Mecánica)',
            'HIST_FWC_6' => 'Argentina 1986 (La gesta de Diego Maradona)',
            'HIST_FWC_7' => 'Brasil 1994 (Tetracampeonato en EE.UU.)',
            'HIST_FWC_8' => 'Brasil 2002 (Pentacampeonato de Ronaldo Nazário)',
            'HIST_FWC_9' => 'Italia 2006 (Cuarta estrella de la Azzurra)',
            'HIST_FWC_10' => 'Alemania 2014 (Victoria germana en el Maracaná)',
            'HIST_FWC_11' => 'Argentina 2022 (Coronación histórica de Lionel Messi)',
        ];
        foreach ($history as $num => $name) {
            DB::table('stickers')->insert([
                'section' => 'history',
                'number' => $num,
                'name' => $name,
                'is_owned' => false,
                'created_at' => now()
            ]);
        }
    }

    /**
     * Mapeo de códigos de país a nombres completos en español
     */
    private function getCountryName(string $code): string
    {
        $map = [
            'MEX'=>'México','RSA'=>'Sudáfrica','KOR'=>'Corea del Sur','CZE'=>'República Checa',
            'BRA'=>'Brasil','MAR'=>'Marruecos','HAI'=>'Haití','SCO'=>'Escocia','GER'=>'Alemania',
            'CUW'=>'Curazao','CIV'=>'Costa de Marfil','ECU'=>'Ecuador','BEL'=>'Bélgica','EGY'=>'Egipto',
            'IRN'=>'Irán','NZL'=>'Nueva Zelanda','FRA'=>'Francia','SEN'=>'Senegal','IRQ'=>'Irak',
            'NOR'=>'Noruega','POR'=>'Portugal','COD'=>'RD Congo','UZB'=>'Uzbekistán','COL'=>'Colombia',
            'CAN'=>'Canadá','BIH'=>'Bosnia y Herzegovina','QAT'=>'Qatar','SUI'=>'Suiza','USA'=>'EE.UU.',
            'PAR'=>'Paraguay','AUS'=>'Australia','TUR'=>'Turquía','NED'=>'Países Bajos','JPN'=>'Japón',
            'SWE'=>'Suecia','TUN'=>'Túnez','ESP'=>'España','CPV'=>'Cabo Verde','KSA'=>'Arabia Saudita',
            'URU'=>'Uruguay','ARG'=>'Argentina','ALG'=>'Argelia','AUT'=>'Austria','JOR'=>'Jordania',
            'ENG'=>'Inglaterra','CRO'=>'Croacia','GHA'=>'Ghana','PAN'=>'Panamá'
        ];
        return $map[$code] ?? strtoupper($code);
    }
}