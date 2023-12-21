1. Uruchomienie aplikacji odbywa się poprzez plik index.php
   2. Plik znajduje się w katalogu public/index.php
   3. Zależnie od konfiguracji serwera, plik powinien uruchomić się automatycznie. (po umieszczeniu kompletu plików w wybranym katalogu na serwerze)
   4. Jeśli plik nie uruchomił się automatycznie, proszę znaleźć folder /public w strukturze katalogów i przejśc do niego
5. **Celem zachowania czytelności wyników, proszę przeglądać stronę w trybie 'view source'**
2. W klasie src/FillingData, w segmencie zawierającycm _$ornamentRepository->addOrnament()_ można poeksperymentować z cenami, celem sprawdzenia funkcjonalności.
   2. Zgodnie z wymaganiami, jeśli dla którejś ozdoby brakuje ceny w danej walucie (podamy wartość 0 zamiast kwoty) - wówczas zestaw cen nie wyswietli się dla danej waluty w ogóle.
      3. jest to 'proteza' symulująca persist danych, więc nie tworzylem calej logiki odpowiedzialnej za zabezpieczenie danych. **Na potrzeby testu proszę wpisywać 0 lub wartości zmiennoprzecinkowe z dokładnościa do 2 miejsc po przecinku**