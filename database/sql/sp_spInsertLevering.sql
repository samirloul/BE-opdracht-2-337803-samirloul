DROP PROCEDURE IF EXISTS spInsertLevering;
-- commit: US02-02

DELIMITER //
CREATE PROCEDURE spInsertLevering(
    IN leverancierIdInput TINYINT,
    IN productIdInput TINYINT,
    IN datumLeveringInput DATE,
    IN aantalInput INT,
    IN datumVolgendeInput DATE
)
BEGIN
    -- 1. Insert delivery
    INSERT INTO ProductPerLeverancier (
        LeverancierId,
        ProductId,
        DatumLevering,
        Aantal,
        DatumEerstVolgendeLevering,
        IsActief,
        DatumAangemaakt,
        DatumGewijzigd
    )
    VALUES (
        leverancierIdInput,
        productIdInput,
        datumLeveringInput,
        aantalInput,
        datumVolgendeInput,
        1,
        SYSDATE(6),
        SYSDATE(6)
    );

    -- 2. Update stock (magazijn)
    UPDATE Magazijn
    SET AantalAanwezig = COALESCE(AantalAanwezig, 0) + aantalInput,
        DatumGewijzigd = SYSDATE(6)
    WHERE ProductId = productIdInput;
END //
DELIMITER ;
