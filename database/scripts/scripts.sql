CREATE OR REPLACE FUNCTION update_updated_at()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_update_updated_at
BEFORE UPDATE ON evento
FOR EACH ROW
EXECUTE FUNCTION update_updated_at();


CREATE OR REPLACE FUNCTION evento_created_at()
RETURNS TRIGGER AS $$
BEGIN
    NEW.created_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_evento_created_at
BEFORE INSERT ON evento
FOR EACH ROW
EXECUTE FUNCTION evento_created_at();
 

