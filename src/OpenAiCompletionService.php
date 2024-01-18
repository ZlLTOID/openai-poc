<?php

declare(strict_types=1);

namespace App;


final class OpenAiCompletionService
{
    use OpenAiConnectableTrait;

    public function getResponse(string $input): string
    {
        $openAi = $this->getOpenAi();

        $chat = $openAi->chat([
            'model' => $_ENV['MODEL'],
            'messages' => [
                [
                    "role" => "system",
                    "content" => "Tvůj nejdůležitější úkol bude na základě vstupu vrátit jídelníček. Vezmeš v úvahu věk uživatele, jeho váhu, případné alergie, oblíbená jídla, pohlaví. Tyto informace jsou důležité, pokud ti je uživatel sám nepředá musíš se na ně sám zeptat. Zohledníš taky jestli chce uživatel zhubnout nebo nabrat svalovou hmotu. Vrátíš počet jídel podle uživatelovi preference v tomto formátu
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
                [
                    "role" => "user",
                    "content" => "{$input}}",
                ]
            ],
            'temperature' => 0.6,
            'max_tokens' => 4096,
            'frequency_penalty' => 0,
            'presence_penalty' => 1,
        ]);

        $chat = json_decode($chat);
        return $chat->choices[0]->message->content;
    }
}
