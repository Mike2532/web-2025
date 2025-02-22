PROGRAM HelloDear(INPUT, OUTPT);
USES
  DOS;
VAR
  Str: STRING;
BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITE('Hello ');
  IF GetEnv('QUERY_STRING') = ''
  THEN
    WRITELN('Anonymus!')
  ELSE
    BEGIN
      WRITE('dear, ');
      Str := GetEnv('QUERY_STRING');
      Delete(Str, 1, 5);
      WRITELN(Str)
    END
END.
