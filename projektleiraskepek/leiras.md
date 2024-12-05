# Miről szól?  
- A projekt célja a Kaposvári Közlekedési Zrt. helyi járatos közlekedésének könnyebb, átláthatóbb felhasználóbarát felületének létrehozása volt.
- A Felhasználói visszajelzések alapján elégedettlenséggel találkoztunk, saját magunk is tapasztaltuk a KKZRT weboldalának bonyolult felépítését.
- Az oldal inspirációt ad egy modern közlekedési oldal létrehozásában.
    - A projekt kifejezetten a KKZRT-nek készül, de a már meglévő https://www.volanbusz.hu/-nak és https://www.mavcsoport.hu/-nak is nyújthat inspirációt
- Tekintettel a felhasználókra online egyszerű jegyrendelés
<img src="[https://github.com/Marietta7747/vizsgaremek/blob/main/projektleiraskepek/jegyvasarlas.jpg](https://github.com/Marietta7747/vizsgaremek/blob/main/projektleiraskepek/jegyvasarlas.JPG)">
	- Külön készítünk jegyrendelés opciót amely könnyen egy űrlap kitöltésével, később fizetési opció hozzáadásával generálhatunk magunknak az utazáshoz szükséges online jegyet  
	<img src="jegytipus.png">  
	
		- **jegytípusok:** 
		    - vonaljegy
		    - napijegy
			- Bérlet (teljes és kedvezményes opció)

- Késés igazolás opció,
	- A mostanában jelentkező súlyos Közlekedési akadályokra való tekintettel létrehoztunk egy késés igazolás opciót, amely megkönnyíti mind a felhasználó mind a jegykiadók dolgát.
	- A felhasználó önmaga tudja előállítani az igazolást, viszont ez visszakereshető és adott esetben szankcionálható, az igazolás pdf formátumban letölthető, elektronikusan igazolt.
	
- Valós idejű lekérdezés.
	- A járatok valós időben nyomon követhetőek, lekérdezhetőek kezdetben nem valós adatokkal.
	- A Máv-nál tapasztalt felhasználói visszajelzések alapján a járat nyomonkövetés opciót bevezetjük a KKZRT-nél amennyiben hozzáférést biztosítanak a járatok helyadatának pontos valós idejű lekérdezéshez. 

# Milyen problémára akar megoldást nyújtani?

- A https://www.kaposbusz.hu/ weboldal használata statikus, pdf-ekkel történik a menetrendek megtekintése csak helyben (jegykiadónál) lehet jegyet vásárolni elavult, nehéz használat.
- Kezdetben mi is sokszor belefutottunk abba a problémába, hogy kiigazodni a város helyi járatos közlekedésén sokszor problémát okozott, az összes járatinformáció pdf-ekkel volt elérhető https://www.kaposbusz.hu/letoltheto-menetrend
- Az online jegyrendelés a fizikai menetjegyek csökkentése, és a helyi járatok használatára való ösztönzése érdekében hoztuk létre
	- Eddig a https://www.kaposbusz.hu weboldalán nem találkoztunk online jegyrendelés opcióval, csak fizikai jegyet lehet vásárolni amely felesleges időt és pénzt(előállítás) emészt fel.
	- És a nem jó helyre eldobott, már fel használt fizikai jegyek rontják a város utcáinak tiszta és rendezett állapotát.

- Az egyre sűrűbben jelentkező probléma a késés és annak igazolása az ebből adódó problémák kikerülése, gördülékenyebb tájékozódás a vidékiek számára is.
	
- A statikus menetrend sokszor bonyolult, erre készítettünk egy dinamikus aktuálisan induló járatfigyelőt.  

- A KKZRT nem rendelkezik saját mobil applikációval, de az általunk fejlesztett weboldal alapvetően responsive mobilon való megtekintésre alkalmas, de van opció a mobil applikációra is.

- Sikerült megvalósítani az online jegy pdf-ként letöltését, ami segít a jegy további használhatóságában még internet elérés nélkül is.

- A bejelentkező felhasználok adatai adatbázisban tárolódnak, regisztráció után saját profilt generálunk amelyben tárolódnak az utas felhasználó adatai, amelyek csak a felhasználónak elérhetőek. 

# Mi a cél?

- Felhasználóbarát környezet kiépítése és egyéb szolgáltatás elérhetővé tétele.  
- A beépített elemekkel a weboldal megjelenése frissebb és modernebb legyen.
- Könnyen használható, értelmezhető utasinformáció megvalósítása.
- A helyi járatos közlekedés és a tömegközlekedés használatának népszerűsítése  

# Milyen hardver és szoftver eszközök?

- **Windows, macOS, Linux operációs rendszer**
- **Google Chrome, Mozilla Firefox, Microsoft Edge, Safari Böngésző**
- **Bármilyen okostelefon, táblagép, vagy személyi számítógép**
- **Minimum 1024 x 768 pixel képernyőfelbontás**
- **Stabil internetkapcsolat szükséges a weboldal teljes funkcionalitásához**  
<span style="float: right;">  
**Készítette: Bogdán László, Falka Marietta**
</span>
