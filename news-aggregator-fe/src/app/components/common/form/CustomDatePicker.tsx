import React, { useState } from "react";
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import { Form, FormText } from "react-bootstrap";
import { useFormContext } from "react-hook-form";
interface DatePickerProps {
  labelText: string;
  name: string;
  errorMessage?: string;
  labelCls?: string;
}

const CustomDatePicker: React.FC<DatePickerProps> = ({
  labelText,
  name,
  errorMessage,
  labelCls,
}) => {
  const { register, setValue } = useFormContext();
  const [datePickerDate, setDatePickerDate] = useState(new Date());
  return (
    <>
      <Form.Group controlId={name}>
        <Form.Label className={labelCls ? labelCls : "ft-14"}>
          {labelText}
        </Form.Label>

        <DatePicker
          selected={datePickerDate}
          {...register(name)}
          onChange={(date: any) => {
            setDatePickerDate(date);
            setValue(name, date);
          }}
          className={`${errorMessage ? "is-invalid" : ""} rounded-0`}
        />
        {errorMessage && (
          <FormText className="text-danger">{errorMessage}</FormText>
        )}
      </Form.Group>
    </>
  );
};

export default CustomDatePicker;
