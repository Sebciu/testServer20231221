1. Uruchomienie aplikacji odbywa się poprzez plik index.php
   2. Plik znajduje się w katalogu public/index.php
   3. Zależnie od konfiguracji serwera, plik powinien uruchomić się automatycznie. (po umieszczeniu kompletu plików w wybranym katalogu na serwerze)
   4. Jeśli plik nie uruchomił się automatycznie, proszę znaleźć folder /public w strukturze katalogów i przejśc do niego

2. **Celem zachowania czytelności wyników, proszę przeglądać stronę w trybie 'view source'**
3. Index.php za kazdym razem generuje losowe $treeId, i na tej podstawie określa rozmiar drzewka dla którego będzie kalkulacja.
   4. W przypadku rozszerzenia aplikacji istnieje możliwość rozszerzenia tej funkcjonalności
3. **Test1** - W klasie _src/FillingData_, w segmencie zawierającycm _$ornamentRepository->addOrnament()_ można poeksperymentować z cenami, celem sprawdzenia funkcjonalności.
   2. Zgodnie z wymaganiami, jeśli dla którejś ozdoby brakuje ceny w danej walucie (podamy wartość 0 zamiast kwoty) - wówczas zestaw cen nie wyswietli się dla danej waluty w ogóle.
      3. jest to 'proteza' symulująca persist danych, więc nie tworzylem calej logiki odpowiedzialnej za zabezpieczenie danych. **Na potrzeby testu proszę wpisywać 0 lub wartości zmiennoprzecinkowe z dokładnościa do 2 miejsc po przecinku**
4. **Test2** - W klasie _src/FillingData_, w segmencie zawierającycm _$ornamentRepository->addTree()_ można poeksperymentować z większymi rozmiarami drzew. 
   5. Na chwilę obecną zabezpieczenia obejmują sytuację, w ktorej rozmiar drzewa jest mniejszy lub równy łącznej liczbie ozdób. (obecnie jest to 9) W przypadku rozbudowy aplikacji, oczywiscie konieczne są dodatkowe zabezpieczenia na taki wypadek.
4. 