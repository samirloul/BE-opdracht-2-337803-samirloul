DROP PROCEDURE IF EXISTS spGetGeleverdeProductenVoorLeverancier;

DELIMITER //
CREATE PROCEDURE spGetGeleverdeProductenVoorLeverancier(
    IN leverancierIdInput TINYINT
)
BEGIN
    SELECT
        p.Id                        AS ProductId,
        p.Naam                      AS ProductNaam,
        m.AantalAanwezig           AS AantalInMagazijn,
        MAX(ppl.DatumLevering)     AS LaatsteLevering
    FROM ProductPerLeverancier ppl
    JOIN Product p
        ON p.Id = ppl.ProductId
    LEFT JOIN Magazijn m
        ON m.ProductId = p.Id
    WHERE ppl.LeverancierId = leverancierIdInput
      AND ppl.IsActief = 1
    GROUP BY
        p.Id,
        p.Naam,
        m.AantalAanwezig
    ORDER BY
        AantalInMagazijn DESC;
END //
DELIMITER ;
