"use client";
import React, { useState } from "react";
import { Form, Row, Col, Card, Container } from "react-bootstrap";
import { FormProvider, useForm } from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup";
import { FeedFilterFormFields, FeedFilterSchema } from "./feedFilterHelpers";
import SubmitButton from "../common/form/SubmitButton";
import { InputField } from "../common/form/InputField";
import { getErrorMessage } from "@/app/utils/auth";
import CustomDatePicker from "../common/form/CustomDatePicker";
import SelectField from "../common/form/SelectField";

export const FeedFilterComponent = () => {
  const [submitLoading, setSubmitLoading] = useState<boolean>(false);
  const [revealed, setRevealed] = useState<boolean>(false);

  const reactHookFormMethods = useForm<FeedFilterFormFields>({
    resolver: yupResolver(FeedFilterSchema),
    mode: "onTouched",
  });

  const {
    handleSubmit,
    setError,
    reset,
    formState: { errors },
  } = reactHookFormMethods;

  const errorMessage = getErrorMessage(errors);

  const sourceNameList = [
    {
      id: "news_api_org",
      name: "News Api Org",
    },
    {
      id: "guardian_api",
      name: "Gurdian Api",
    },
    {
      id: "nytimes_api",
      name: "Nytime Api",
    },
  ];

  const [categories, setCategories] = useState([]);

  const onSubmit = async (data: FeedFilterFormFields) => {
    console.log("payload", data);
  };

  return (
    <>
      <Container>
        <Row className="py-2">
          <Col>
            <Card className="border border-0">
              <Card.Body>
                <Row>
                  <Col md={{ span: 8, offset: 2 }}>
                    <FormProvider {...reactHookFormMethods}>
                      <Form className="py-2" onSubmit={handleSubmit(onSubmit)}>
                        <Row className="mb-2">
                          <Col md="4">
                            <InputField
                              labelText="Filter"
                              inputType="text"
                              name="q"
                              placeholder="Search any keywords"
                              errorMessage={errorMessage("q")}
                            />
                          </Col>
                          <Col md="4">
                            <CustomDatePicker
                              labelText="Start Date"
                              name="startDate"
                              errorMessage={errorMessage("startDate")}
                            />
                          </Col>
                          <Col md="4">
                            <CustomDatePicker
                              labelText="End Date"
                              name="endDate"
                              errorMessage={errorMessage("endDate")}
                            />
                          </Col>
                        </Row>
                        <Row className="mb-2">
                          <Col md="4">
                            <SelectField
                              labelText="Source"
                              fieldName="source"
                              selectData={sourceNameList}
                              errorMessage={errorMessage("source")}
                            />
                          </Col>
                          <Col md="4">
                            <SelectField
                              labelText="Category"
                              fieldName="category"
                              selectData={categories}
                              errorMessage={errorMessage("category")}
                            />
                          </Col>
                          <Col md="4">
                            <div className="mt-3">
                              <SubmitButton
                                title="Search"
                                isLoading={submitLoading}
                                loadingTitle=""
                                buttonCls="w-100 mt-3 signup-btn"
                                variant="primary"
                                isDisabled={submitLoading}
                              />
                            </div>
                          </Col>
                        </Row>
                      </Form>
                    </FormProvider>
                  </Col>
                </Row>
              </Card.Body>
            </Card>
          </Col>
        </Row>
      </Container>
    </>
  );
};
