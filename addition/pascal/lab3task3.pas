PROGRAM HelloDear(INPUT, OUTPUT);
USES
  DOS;
VAR
  Str, Ans, Temp: STRING;
  I, PosAmp, Len: INTEGER;
BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITE('Hello ');
  Str := GetEnv('QUERY_STRING');
  I := Pos('name=', Str);
  Len := Length(Str);
  IF (Str = '') OR (I = 0) OR (Str[I+5] = '&') OR ((I <> 1) AND (Str[I-1] <> '&')) OR (I + 5 = Len)  
  THEN
    WRITELN('Anonymus!')
  ELSE
    BEGIN
      WRITE('dear, ');
      I := I + 5;
      Ans := '';
      Temp := Copy(Str, I, Len - I + 1);
      PosAmp := Pos('&', Temp);
      IF PosAmp = 0
      THEN
        WRITE(Temp)
      ELSE
        BEGIN
          Ans := Copy(Temp, 1, PosAmp - 1);
          WRITELN(Ans)
        END; 
    END
END.