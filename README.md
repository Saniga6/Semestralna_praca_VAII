# Semestrálna práca VAII

## Návod na inštaláciu

### Požiadavky
Pred spustením aplikácie sa uistite, že máte nainštalované:
- IDE s podporou Dockera (napr. PhpStorm, Visual Studio Code)
- [Docker Desktop](https://www.docker.com/products/docker-desktop)

---

### Kroky na inštaláciu

1. **Stiahnutie zdrojového kódu**
   - Stiahnite kód priamo z repozitára vo formáte ZIP **alebo**
   - Naklonujte repozitár pomocou príkazu:
     ```bash
     git clone https://github.com/username/Semestralna_praca_VAII.git
     ```

2. **Otvorte projekt v IDE**
   - Spustite vaše IDE a otvorte priečinok so stiahnutým alebo naklonovaným projektom.

3. **Spustenie Docker kontajnerov**
   - Uistite sa, že Docker Desktop je spustený.
   - V IDE otvorte súbor `docker/docker-compose.yml` a spustite konfiguráciu. Ak IDE nepodporuje Docker Compose, použite tento príkaz v termináli:
     ```bash
     docker-compose -f docker/docker-compose.yml up --build
     ```

4. **Otvorte aplikáciu v prehliadači**
   - Po úspešnom spustení Dockera otvorte váš webový prehliadač a prejdite na adresu:
     ```
     http://localhost
     ```

---
