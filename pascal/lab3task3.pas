PROGRAM HelloDear(INPUT, OUTPT);
USES
  DOS;
VAR
  Str, Ans: STRING;
  I: INTEGER;
BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITE('Hello ');
  Str := GetEnv('QUERY_STRING');
  IF (GetEnv('QUERY_STRING') = '') OR (Pos('name=', Str) = 0)
  THEN
    WRITELN('Anonymus!')
  ELSE
    BEGIN
      I := Pos('name=', Str) + 5;
      Ans := '';
      WRITE('dear, ');
      WHILE (Str[I] <> '&') AND (I < Length(Str) + 1)
      DO
        BEGIN
          Ans += Str[I];
          Inc(I) 
        END;
      WRITELN(Ans)  
    END
END.
