# Depozyt

Aplikacja Bankowa stworzona przy pomocy frameworku Laravel. Strona dostępna obecnie pod adresem https://serwisdepozytowy.pl
Jej funkcje to m.in:
- Tworzenie i edycja użytkowników oraz administratorów
- Podział kont użytkownika na kategorie i szegółowa edycja danych
- Uwierzytelnianie konta użytkownika przy pomocy adresu e-mail
- Uwierzytelnianie logowań na konta administratora przy pomocy kodu SMS
- Wirtualny portfel
- Obsługa transakcji zawartości wirutalnego portwela między użytkownikami. Po utworzeniu transakcji wymagane jest potwierdzenie obu stron, aby została wykonana.
- System umożliwiający obsługę wielu języków na stronie. Obecnie zaimplementowany język Angielski i Polski.
- Rozbudowany panel administracyjny zawierający takie funkcje jak:
  - Edycja/Tworzenie/Usuwanie/Zarządzanie kontami użytkowników i administratorów
  - Zarządzanie danymi na stronie takimi jak np. Waluta, Lista dostępnych krajów, typy użytkowników
  - Eksport/import transakcji do/z pliku CSV. Importowane/eksportowanie wpływa na zawartość portefli użytkowników
  - System wyłapywania wyjątków na stronie. Każdy znaleziony wyjątek zostaje odpowiednio obsłużony, zapisany w logu dostępnym w panelu administracyjnym, oraz wysłany zostaje E-mail do administratorów z powiadomieniem o zdarzeniu.
