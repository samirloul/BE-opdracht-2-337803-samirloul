DROP PROCEDURE IF EXISTS spGetProductenPerLeverancier;

DELIMITER //
CREATE PROCEDURE spGetProductenPerLeverancier(IN leverancierIdInput TINYINT)
BEGIN
    SELECT
        p.Id AS ProductId,
        p.Naam AS ProductNaam,
        p.Barcode,
        ppl.DatumLevering,
        ppl.Aantal,
        ppl.DatumEerstVolgendeLevering
    FROM ProductPerLeverancier ppl
    JOIN Product p ON p.Id = ppl.ProductId
    WHERE ppl.LeverancierId = leverancierIdInput
      AND ppl.IsActief = 1
    ORDER BY ppl.DatumLevering DESC;
END //
DELIMITER ;
