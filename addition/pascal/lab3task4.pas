PROGRAM FindParam(INPUT, OUTPUT);
USES
  DOS;

FUNCTION GetQueryStringParameter(Key: STRING): STRING;
VAR
  Ans, Temp, Str: STRING;
  PosAmp, Len, I, LengthOfKey: INTEGER;
BEGIN
  Str := GetEnv('QUERY_STRING');
  I := Pos(Key, Str);
  Len := Length(Str);
  LengthOfKey := Length(Key);
  IF NOT((Str = '') OR (I = 0) OR (Str[I + LengthOfKey] = '&') OR ((I <> 1) AND (Str[I - 1] <> '&')) OR (I + LengthOfKey = Len))  
  THEN
    BEGIN
      I := I + LengthOfKey;
      Ans := '';
      Temp := Copy(Str, I, Len - I + 1);
      PosAmp := Pos('&', Temp);
      IF PosAmp = 0
      THEN
        Ans := Temp
      ELSE
        Ans := Copy(Temp, 1, PosAmp - 1);
    END;    
  GetQueryStringParameter := Ans
END;

BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITELN('First Name: ', GetQueryStringParameter('first_name'));
  WRITELN('Last Name: ', GetQueryStringParameter('last_name'));
  WRITELN('Age: ', GetQueryStringParameter('age'));
END.