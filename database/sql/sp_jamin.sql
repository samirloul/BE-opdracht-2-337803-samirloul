-- **********************************************************************************
-- Stored procedure: Overzicht leveranciers met aantal verschillende producten
-- **********************************************************************************

DROP PROCEDURE IF EXISTS spGetLeveranciersMetAantalProducten;

DELIMITER //
CREATE PROCEDURE spGetLeveranciersMetAantalProducten()
BEGIN
    SELECT
        l.Id,
        l.Naam,
        l.ContactPersoon,
        l.LeverancierNummer,
        l.Mobiel,
        COUNT(DISTINCT ppl.ProductId) AS AantalVerschillendeProducten
    FROM Leverancier l
    LEFT JOIN ProductPerLeverancier ppl
        ON ppl.LeverancierId = l.Id
       AND ppl.IsActief = 1
    WHERE l.IsActief = 1
    GROUP BY
        l.Id,
        l.Naam,
        l.ContactPersoon,
        l.LeverancierNummer,
        l.Mobiel
    ORDER BY AantalVerschillendeProducten DESC;
END //
DELIMITER ;
