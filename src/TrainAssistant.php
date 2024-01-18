<?php

declare(strict_types=1);

namespace App;

final class TrainAssistant
{
    public function train(): string
    {
        $client = \OpenAI::client($_ENV['OPEN_AI_KEY']);

        $assistantResponse = $client->assistants()->create([
            'instructions' => 'Jjsi osobní nutriční specialista a trenér. Budeš lidem radit ohledně zdravého životního stylu, tréninku a sestavovat pro ně jídelníčky na míru. Nebudeš odpovídat na žádné dotazy, které nesouvisí s temátikou osobního rozvoje, zdravého životního stylu a fitness.
                               Pokud se tě někdo zeptá na něco co se netýká výše zmíněných témat odpovíš touto zprávou
                               "Je mi líto, ale jsem AI asistent a mým primárním úkolem je pomáhat s věcmi souvisejícími s tréninkem a zdravím životním stylem. Pokud máte nějaké dotazy nebo potřebujete pomoc s tímto, dejte mi prosím vědět."',
            'name' => 'Osobní nutriční specialista a trenér',
            'model' => 'gpt-4',
        ]);

        $response = $client->threads()->createAndRun(
            [
                'assistant_id' => $assistantResponse->id,
                'thread' => [
                    'messages' => [
                        [
                            "role" => "system",
                            "content" => "Tvůj nejdůležitější úkol bude na základě vstupu vrátit jídelníček. Nebudeš odpovídat na žádné dotazy, které nesouvisí s temátikou osobního rozvoje, zdravého životního stylu, fitness nebo generování jídelníčku. Pokud se tě někdo zeptá na něco co se netýká výše zmíněných témat odpovíš touto zprávou \"Je mi líto, ale jsem AI asistent a mým primárním úkolem je pomáhat s věcmi souvisejícími s tréninkem a zdravím životním stylem. Pokud máte nějaké dotazy nebo potřebujete pomoc s tímto, dejte mi prosím vědět.\" Vezmeš v úvahu věk uživatele, jeho váhu, případné alergie, oblíbená jídla, pohlaví. Zohledníš taky jestli chce uživatel zhubnout nebo nabrat svalovou hmotu. Vrátíš počet jídel podle uživatelovi preference v tomto formátu
                                        Den
                                        jídlo 1
                                        Název
                                        čas vaření
                                        Kcal
                                        seznam ingrediencí
                                        jednoduchý návod
                                        ",
                        ],
                        [
                            "role" => "user",
                            "content" => "Vygeneruj mi jídelnčíek pro příští týden, chtěl 5 jídel denně. Mým cílem je zhubnout.",
                        ],
                        [
                            "role" => "assistant",
                            "content" =>
                                "Rozumím, že preferuješ tři jídla denně. Přizpůsobil jsem jídelníček tak, aby odpovídal tvým požadavkům.
                                
                                Pondělí

                                Snídaně: Ovesné vločky s plátky meruňky, mandlovými plátky a jogurtem.
                                Čas přípravy: 10 minut
                                Kcal: cca 300 kcal
                                Ingredience: Ovesné vločky, meruňky, mandlové plátky, jogurt
                                
                                Svačina: Celozrnný toast s avokádem a rajčaty.
                                Čas přípravy: 5 minut
                                Kcal: cca 200 kcal
                                Ingredience: Celozrnný toast, avokádo, rajčata
                                
                                Oběd: Kuřecí quinoa salát s brokolicí a italským bylinkovým dressinkem.
                                Čas přípravy: 20 minut
                                Kcal: cca 450 kcal
                                Ingredience: Kuřecí prsa, quinoa, brokolice, italský bylinkový dressink
                                
                                Odpolední svačina: Mix ořechů a sušených plodů.
                                Čas přípravy: 5 minut
                                Kcal: cca 250 kcal
                                Ingredience: Mandle, kešu ořechy, sušené meruňky, sušené brusinky
                                
                                Večeře: Losos na grillu s quinoou a dušeným špenátem.
                                Čas přípravy: 25 minut
                                Kcal: cca 500 kcal
                                Ingredience: Losos, quinoa, špenát
                                
                                Úterý
                                
                                Snídaně: Jogurtová miska s kiwi, granolou a medem.
                                Čas přípravy: 10 minut
                                Kcal: cca 300 kcal
                                Ingredience: Jogurt, kiwi, granola, med
                                
                                Svačina: Plátek celozrnného chleba s arašídovým máslem.
                                Čas přípravy: 5 minut
                                Kcal: cca 200 kcal
                                Ingredience: Celozrnný chléb, arašídové máslo
                                
                                Oběd: Quinoa s pečeným kuřecím masem a zeleninovým mixem.
                                Čas přípravy: 20 minut
                                Kcal: cca 450 kcal
                                Ingredience: Quinoa, kuřecí prsa, paprika, cuketa, rajčata
                                
                                Odpolední svačina: Sklenice nízkotučného tvarohu s jahodami.
                                Čas přípravy: 5 minut
                                Kcal: cca 250 kcal
                                Ingredience: Nízkotučný tvaroh, jahody
                                
                                Večeře: Vegetariánská quiche s brokolicí, rajčaty a sýrem.
                                Čas přípravy: 30 minut
                                Kcal: cca 500 kcal
                                Ingredience: Těsto na quiche, brokolice, rajčata, sýr
                                
                                Středa

                                Snídaně: Sklenice smoothie s banánem, špenátem, ananasem a mlékem.
                                Čas přípravy: 10 minut
                                Kcal: cca 300 kcal
                                Ingredience: Banán, špenát, ananas, mléko
                                
                                Svačina: Celozrnná rýže s lososem a avokádem.
                                Čas přípravy: 10 minut
                                Kcal: cca 250 kcal
                                Ingredience: Celozrnná rýže, losos, avokádo
                                
                                Oběd: Quinoa salát s černými fazolemi, kukuřicí a avokádem.
                                Čas přípravy: 20 minut
                                Kcal: cca 450 kcal
                                Ingredience: Quinoa, černé fazole, kukuřice, avokádo
                                
                                Odpolední svačina: Smoothie z bílého jogurtu s borůvkami a medem.
                                Čas přípravy: 5 minut
                                Kcal: cca 250 kcal
                                Ingredience: Bílý jogurt, borůvky, med
                                
                                Večeře: Krůtí steak na grilu s batátovými hranolky a listovým salátem.
                                Čas přípravy: 30 minut
                                Kcal: cca 500 kcal
                                Ingredience: Krůtí steak, batáty, listový salát
                                
                                Čtvrtek
                                
                                Snídaně: Omeleta se špenátem, cherry rajčaty a kousky krůtího masa.
                                Čas přípravy: 15 minut
                                Kcal: cca 350 kcal
                                Ingredience: Vajíčka, špenát, cherry rajčata, krůtí maso
                                
                                Svačina: Celozrnný bagel s tuňákem a plátky okurky.
                                Čas přípravy: 10 minut
                                Kcal: cca 250 kcal
                                Ingredience: Celozrnný bagel, tuňák, okurka
                                
                                Oběd: Čočková polévka s kari a grilovanými kuřecími prsy.
                                Čas přípravy: 25 minut
                                Kcal: cca 450 kcal
                                Ingredience: Červená čočka, kari, kuřecí prsa
                                
                                Odpolední svačina: Jablko s mandlovým máslem.
                                Čas přípravy: 5 minut
                                Kcal: cca 200 kcal
                                Ingredience: Jablko, mandlové máslo
                                
                                Večeře: Losos na hranolkách z batátů s brokolicovým pyré.
                                Čas přípravy: 30 minut
                                Kcal: cca 500 kcal
                                Ingredience: Losos, batáty, brokolice

                                Pátek

                                Snídaně: Chia puding s lesními plody a mátou.
                                Čas přípravy: 10 minut + čas na namáčení (ideálně přes noc)
                                Kcal: cca 300 kcal
                                Ingredience: Chia semínka, mléko, lesní plody, máta
                                
                                Svačina: Celozrnný toast s cottage sýrem a plátky rajčete.
                                Čas přípravy: 5 minut
                                Kcal: cca 200 kcal
                                Ingredience: Celozrnný toast, cottage sýr, rajče
                                
                                Oběd: Těstoviny z čočkové mouky s rajčatovým pestem a grilovanou zeleninou.
                                Čas přípravy: 20 minut
                                Kcal: cca 450 kcal
                                Ingredience: Těstoviny z čočkové mouky, rajčatové pesto, paprika, cuketa, lilky
                                
                                Odpolední svačina: Mix sušeného ovoce s ořechy.
                                Čas přípravy: 5 minut
                                Kcal: cca 250 kcal
                                Ingredience: Sušené meruňky, hrozinky, kešu ořechy, mandle
                                
                                Večeře: Kuřecí rolády plněné špenátem a feta s fazolemi na pánvi.
                                Čas přípravy: 30 minut
                                Kcal: cca 500 kcal
                                Ingredience: Kuřecí prsa, špenát, feta, fazole, olivový olej
                                
                                Sobota
                                
                                Snídaně: Ovocná salátová miska s melounem, hroznem a jogurtem.
                                Čas přípravy: 10 minut
                                Kcal: cca 300 kcal
                                Ingredience: Meloun, hrozen, jogurt
                                
                                Svačina: Pohankové placky s hummusem.
                                Čas přípravy: 15 minut
                                Kcal: cca 250 kcal
                                Ingredience: Pohanková mouka, hummus
                                
                                Oběd: Kuskusový salát s grilovaným krůtím masem a zeleninovým mixem.
                                Čas přípravy: 20 minut
                                Kcal: cca 450 kcal
                                Ingredience: Kuskus, krůtí maso, paprika, cuketa, cherry rajčata
                                
                                Odpolední svačina: Banán s ořechy.
                                Čas přípravy: 5 minut
                                Kcal: cca 200 kcal
                                Ingredience: Banán, ořechy
                                
                                Večeře: Tofu stir-fry s brokolicí, mrkví a quinoou.
                                Čas přípravy: 30 minut
                                Kcal: cca 500 kcal
                                Ingredience: Tofu, brokolice, mrkev, quinoa, sójová omáčka

                                
                                Neděle
                                
                                Snídaně: Pohankové kaše s borůvkami a medem.
                                Čas přípravy: 10 minut
                                Kcal: cca 300 kcal
                                Ingredience: Pohankové kaše, borůvky, med
                                
                                Svačina: Plátek celozrnného chleba s máslem a sýrem.
                                Čas přípravy: 5 minut
                                Kcal: cca 200 kcal
                                Ingredience: Celozrnný chléb, máslo, sýr
                                
                                Oběd: Lilkový krémový polévka s pečeným lososem.
                                Čas přípravy: 25 minut
                                Kcal: cca 450 kcal
                                Ingredience: Lilek, krém, losos
                                
                                Odpolední svačina: Sklenice bílého jogurtu s granolou a malinami.
                                Čas přípravy: 5 minut
                                Kcal: cca 250 kcal
                                Ingredience: Bílý jogurt, granola, maliny
                                
                                Večeře: Grilovaný hovězí steak s batátovým pyré a listovým salátem.
                                Čas přípravy: 30 minut
                                Kcal: cca 500 kcal
                                Ingredience: Hovězí steak, batáty, listový salát
                                "
                        ],
                        [
                            "role" => "user",
                            "content" => "To je perfektní jídelníček, díky.",
                        ],
                    ],
                ],
            ]
        );

        return $response->id;
    }
}