-- Function: calc_demurrage_coast(interval)

--DROP FUNCTION add_offset_to_coords(IN lon double precision, IN lat double precision, IN meter_offset int);

CREATE OR REPLACE FUNCTION add_offset_to_coords(IN lon double precision, IN lat double precision, IN meter_offset int)
  RETURNS RECORD AS
$BODY$
DECLARE
	MAJOR_AXIS double precision;
	k double precision;
	pk double precision;
	dist_lat double precision;
	dist_lon double precision;
	ret RECORD;
BEGIN
	MAJOR_AXIS = 6378137.0; --meters
	k = (meter_offset / MAJOR_AXIS)::double precision;
	pk = (180/3.14169)::double precision;
	dist_lat = (pk * k)::double precision;
	dist_lon = (pk * k / cos(lat))::double precision;

	ret = (lat + dist_lat,
	     lon + dist_lon,
	     lat - dist_lat,
	     lon - dist_lon
	     );
	RETURN ret;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION add_offset_to_coords(IN lon double precision, IN lat double precision, IN meter_offset int)
  OWNER TO beton;
