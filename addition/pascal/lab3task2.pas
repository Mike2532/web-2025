PROGRAM SarahRever(INPUT, OUTPUT);
USES
  DOS;
VAR
  Str: STRING;
BEGIN
  Str := GetEnv('QUERY_STRING');
  WRITELN('Content-Type: text/plain');
  WRITELN;
  IF Str = 'lanters=1'
  THEN
    WRITELN('The British are camming by land')
  ELSE
    IF Str = 'lanters=2'
    THEN
      WRITELN('The British are camming by sea')
    ELSE
      WRITELN('Sarah didnt say')
END.
