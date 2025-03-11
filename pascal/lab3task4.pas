PROGRAM FindParam(INPUT, OUTPUT);
USES
  DOS;
VAR
  I: INTEGER;
  Str: STRING;

FUNCTION GetQueryStringParameter(Key: STRING): STRING;
VAR
  Ans: STRING;
BEGIN
  Ans := '';

  IF POS(Key, Str) <> 0
  THEN
    BEGIN
      I := Pos(Key, Str);
      WHILE Str[I] <> '='
      DO
        Inc(I);
      Inc(I);
      WHILE (Str[I] <> '&') AND (I < Length(Str) + 1)
      DO
        BEGIN
          Ans += Str[I];
          Inc(I) 
        END
    END;
  GetQueryStringParameter := Ans;
END;


BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  Str := GetEnv('QUERY_STRING');
  WRITELN('First Name: ', GetQueryStringParameter('first_name'));
  WRITELN('Last Name: ', GetQueryStringParameter('last_name'));
  WRITELN('Age: ', GetQueryStringParameter('age'));
END.


age=18214125125125&
