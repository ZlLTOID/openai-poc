<?php

declare(strict_types=1);

namespace App;


final class OpenAiService
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
                    "content" => "Jsi asistent, který na základě vstupu vrátí jídelníček. Nesloužíš k ničemu jinému. Vezmeš v úvahu věk uživatele, jeho váhu, případné alergie, oblíbená jídla, pohlaví. Zohledníš taky jestli chce uživatel zhubnout nebo nabrat svalovou hmotu. Vrátíš počet jídel podle uživatelovi preference v tomto formátu
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
                    "content" => "[no prose] Vygeneruj mi 3 jídla denně, které budou obsahovat maso a zeleninu, budou zdravá a budou mi chutnat. Mým cílem je nabrat svaly.",
                ],
                [
                    "role" => "assistant",
                    "content" =>
                        "Rozumím, že preferuješ tři jídla denně. Přizpůsobil jsem jídelníček tak, aby odpovídal tvým požadavkům.
                        Den 1
                        Jídlo 1: Snídaně
                        Ovesná kaše s ovocem a ořechy
                        Čas vaření: 10 minut
                        Kcal: cca 350 kcal
                        Ingredience: ovesné vločky, mléko, banán, jahody, mandle
                        Návod: Uvařte ovesné vločky v mléce, přidejte na kousky nakrájený banán, jahody a posypte ořechy.
                        Jídlo 2: Oběd
                        Kuřecí prsa se zeleninovým salátem
                        Čas přípravy: 30 minut
                        Kcal: cca 500 kcal
                        Ingredience: kuřecí prsa, brokolice, mrkev, cherry rajčata, quinoa
                        Návod: Osmažte kuřecí prsa, přidejte dusenou quinou a podávejte s vařenou zeleninou.
                        Jídlo 3: Večeře
                        Losos na grillu s brokolicovým pyré
                        Čas přípravy: 20 minut
                        Kcal: cca 500 kcal
                        Ingredience: losos, brokolice, brambory, olivový olej
                        Návod: Grilujte losos a podávejte ho s pyré z vařené brokolice a brambor.
                        Tento upravený jídelníček zahrnuje snídani, oběd a večeři, což by mělo splňovat tvé požadavky na tři jídla denně. Přizpůsob si prosím velikosti porcí podle svých individuálních potřeb a sleduj svůj pokrok. Pamatujte, že je vždy dobré konzultovat s odborníkem na výživu, pokud máte specifické zdravotní nebo výživové potřeby.
                        Den 2
                        Jídlo 1: Snídaně
                        Rychlá vaječná omeleta se špenátem a rajčaty
                        Čas přípravy: 15 minut
                        Kcal: cca 300 kcal
                        Ingredience: vajíčka, špenát, rajčata, sůl, pepř
                        Návod: Omeletu smíchejte s nastrouhaným špenátem a nakrájenými rajčaty.
                        Jídlo 2: Oběd
                        Quinoa salát s čerstvou zeleninou a kuřecím masem
                        Čas přípravy: 20 minut
                        Kcal: cca 450 kcal
                        Ingredience: quinoa, okurka, paprika, cherry rajčata, kuřecí prsa, olivový olej
                        Návod: Uvařte quinou, smíchejte s nakrájenou zeleninou a grilovanými kuřecími prsy.
                        Jídlo 3: Večeře
                        Plátek hovězího masa s pečenými batáty a restovanou zeleninou
                        Čas přípravy: 30 minut
                        Kcal: cca 550 kcal
                        Ingredience: hovězí maso, batáty, cuketa, paprika, olivový olej
                        Návod: Restujte hovězí maso na pánvi a podávejte s pečenými batáty a restovanou zeleninou.
                        Den 3
                        Jídlo 1: Snídaně
                        Smoothie s banánem, borůvkami a bílým jogurtem
                        Čas přípravy: 10 minut
                        Kcal: cca 300 kcal
                        Ingredience: banán, borůvky, bílý jogurt, med
                        Návod: Mixujte banán, borůvky a jogurt a podávejte s lžící medu.
                        Jídlo 2: Oběd
                        Ryba na páře se zeleninovým rýžovým salátem
                        Čas přípravy: 25 minut
                        Kcal: cca 400 kcal
                        Ingredience: ryba, rýže, brokolice, mrkev, sójová omáčka
                        Návod: Rybu perte, opepřete a poduste na páře. Rýži smíchejte se zeleninou a dochuťte sójovou omáčkou.
                        Jídlo 3: Večeře
                        Cizrna na kari s jasmínovou rýží
                        Čas přípravy: 30 minut
                        Kcal: cca 500 kcal
                        Ingredience: cizrna, cibule, rajčata, kokosové mléko, jasmínová rýže
                        Návod: Uvařte cizrnu s rajčaty, cibulí a kokosovým mlékem. Podávejte s jasmínovou rýží.
                        "
                ],
                [
                    "role" => "user",
                    "content" => "To je perfektní výstup.",
                ],
                [
                    "role" => "user",
                    "content" => "[no prose] {$input}",
                ],
            ],
            'temperature' => 0.6,
            'max_tokens' => 500,
            'frequency_penalty' => 0,
            'presence_penalty' => 1,
        ]);

        $chat = json_decode($chat);
        return $chat->choices[0]->message->content;
    }
}
